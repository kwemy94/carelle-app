<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionnaireRepository;

class QuestionnaireController extends Controller
{

    private $questionnaireRepository;
    private $answerRepository;

    public function __construct(QuestionnaireRepository $questionnaireRepository, AnswerRepository $answerRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
        $this->answerRepository = $answerRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionnaires = $this->questionnaireRepository->getAll(2);
        $answers = $this->answerRepository->getAll();
        return view('admin.questionnaire.index', compact('questionnaires', 'answers'));
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
        $inputs = $request->all();

        try {
            $this->questionnaireRepository->store($inputs);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['success' => false, "message" => "une erreur : " . $th->getMessage()]);
        }

        return redirect()->back()->with(['success' => true, "message" => "Questionnaire crée !"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $questionnaire = $this->questionnaireRepository->getQuestions($id);
        $questionnaires = $this->questionnaireRepository->getAll();
        // dd($questionnaire);
        return view('quiz', compact('questionnaire', 'questionnaires'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questionnaire $questionnaire)
    {
        try {
            $questionnaire->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['success' => false, "message" => "une erreur : " . $th->getMessage()]);
        }
        return redirect()->back()->with(['success' => true, "message" => "Questionnaire supprimé !"]);
    }

    public function publishQuiz($id)
    {

        try {
            $quiz = $this->questionnaireRepository->getById($id);
            if ($quiz->status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $this->questionnaireRepository->update($id, ['status' => $status]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['success' => false, "message" => "une erreur : " . $th->getMessage()]);
        }
        return redirect()->back()->with(['success' => true, "message" => "Status mis à jour !"]);


    }
}
