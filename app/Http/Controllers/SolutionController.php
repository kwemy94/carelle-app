<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\AnswerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SolutionRepository;
use App\Repositories\QuestionnaireRepository;

class SolutionController extends Controller
{
    private $solutionRepository;
    private $answerRepository;
    private $questionnaireRepository;
    private $categoryRepository;

    public function __construct(SolutionRepository $solutionRepository, AnswerRepository $answerRepository,
        QuestionnaireRepository $questionnaireRepository, CategoryRepository $categoryRepository){
        $this->solutionRepository = $solutionRepository;
        $this->answerRepository = $answerRepository;
        $this->questionnaireRepository = $questionnaireRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */  
    public function index()
    {
        $solutions = $this->solutionRepository->getAll();
        $questionnaires = $this->questionnaireRepository->getAll(2);
        $answers = $this->answerRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.solution.index', compact('categories','answers', 'questionnaires', 'solutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->only(['intitule', 'description']);
        $inputPivot['marge_inf'] = $request->marge_inf;
        $inputPivot['marge_sup'] = $request->marge_sup;
        // dd($inputs, $inputPivot);
        try {
            DB::transaction(function() use($inputs, $inputPivot, $request) {
                $solution = $this->solutionRepository->store($inputs);

                $solution->category()->attach($request->category_id, $inputPivot);

            });
            
        } catch (\Throwable $th) {
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Solution crée !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Solution $solution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solution $solution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solution $solution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $solution = $this->solutionRepository->getById($id);
        $solution->authors()->detach($author->id);
    }
}
