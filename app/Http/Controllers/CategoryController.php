<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\AnswerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionnaireRepository;

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
        // dd($request->all());
        $inputs = $request->except('lines');
        $lines = $request->lines;
        // dd($inputs, $lines);
        try {
            DB::transaction(function () use ($inputs, $lines, $request) {
                $category = $this->categoryRepository->store($inputs);

                foreach ($lines['question'] as $key => $value) {
                    $question = [
                        'intitule' => $value,
                        'response' => $lines['response'][$key],
                        'category_id' => $category->id,
                        // 'cotation' => $lines['cotation'][$key]
                        'cotation' => 0,
                        'type' => $lines['type'][$key]
                    ];

                    $this->questionRepository->store($question);
                }
                # Update cotation
                $updateCotations = $this->questionnaireRepository->updateCotation($request->questionnaire_id);
                foreach ($updateCotations['questions'] as $key => $question) {
                    if ($question->type == 1) {
                        $this->questionRepository->update($question->id, ['cotation' => $updateCotations['cotationPerception']]);
                    }
                    if ($question->type == 0) {
                        $this->questionRepository->update($question->id, ['cotation' => $updateCotations['cotationImportance']]);
                    }
                    if ($question->type == 2) {
                        $this->questionRepository->update($question->id, ['cotation' => $updateCotations['cotationAttente']]);
                    }
                }
            });
        } catch (Exception $ex) {
            // dd(11);
            errorManager("Store category error : ", $ex, $ex);
            $notification = array(
                'message' => "une erreur s'est produite " . $ex->getMessage(),
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
    public function show($id)
    {
        $questionnaires = $this->questionnaireRepository->getAll(2);
        $answers = $this->answerRepository->getAll();
        $category = $this->categoryRepository->getById($id);

        return view('admin.methode.show', compact('answers', 'category', 'questionnaires'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getById($id);
        $questionnaires = $this->questionnaireRepository->getAll(2);

        $view = view('admin.methode.edit', compact('category', 'questionnaires'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->except('lines');
        $lines = $request->lines;
        // dd($inputs, $lines);
        try {
            DB::transaction(function () use ($inputs, $lines, $id, $request) {
                $this->categoryRepository->update($id, $inputs);

                foreach ($lines['question'] as $key => $value) {
                    $question = [
                        'intitule' => $value,
                        'response' => $lines['response'][$key],
                        'category_id' => $id,
                        'cotation' => 0,
                        'type' => $lines['type'][$key]
                    ];

                    if (isset($lines['key_id'][$key])) {
                        $this->questionRepository->update($lines['key_id'][$key], $question);
                    } else {
                        $this->questionRepository->store($question);
                    }

                    # Update cotation
                    $updateCotations = $this->questionnaireRepository->updateCotation($request->questionnaire_id);
                    foreach ($updateCotations['questions'] as $key => $question) {
                        if ($question->type == 1) {
                            $this->questionRepository->update($question->id, ['cotation' => $updateCotations['cotationPerception']]);
                        }
                        if ($question->type == 0) {
                            $this->questionRepository->update($question->id, ['cotation' => $updateCotations['cotationImportance']]);
                        }
                        if ($question->type == 2) {
                            $this->questionRepository->update($question->id, ['cotation' => $updateCotations['cotationAttente']]);
                        }
                    }

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
            'message' => "Catégorie mise à jour !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
            errorManager("Suppression catégorie : ", $th, $th);
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
