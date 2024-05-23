<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CategoryRepository;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;

class CategoryController extends Controller
{

    private $categoryRepository;
    private $questionnaireRepository;
    private $questionRepository;
    private $answerRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        QuestionnaireRepository $questionnaireRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->questionnaireRepository = $questionnaireRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $methodes = $this->categoryRepository->getAll();
        $questionnaires = $this->questionnaireRepository->getAll(2);
        $answers = $this->answerRepository->getAll();

        return view('admin.methode.index', compact('answers', 'methodes', 'questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questionnaires = $this->questionnaireRepository->getAll(2);
        $answers = $this->answerRepository->getAll();

        return view('admin.methode.create', compact('answers', 'questionnaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->except('lines');
        $lines = $request->lines;
        // dd($inputs, $lines);
        try {
            DB::transaction(function () use ($inputs, $lines) {
                $category = $this->categoryRepository->store($inputs);

                foreach ($lines['question'] as $key => $value) {
                    $question = [
                        'intitule' => $value,
                        'response' => $lines['response'][$key],
                        'category_id' => $category->id,
                        'cotation' => $lines['cotation'][$key]
                    ];

                    $this->questionRepository->store($question);
                }
            });
        } catch (\Throwable $th) {
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Catégorie crée !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->getById($id);
            $category->delete();
        } catch (\Throwable $th) {
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Catégorie supprimée !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
