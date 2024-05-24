<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\SettingRepository;

class QuestionnaireController extends Controller
{

    private $questionnaireRepository;
    private $answerRepository;
    private $settingRepository;

    public function __construct(QuestionnaireRepository $questionnaireRepository, AnswerRepository $answerRepository,
            SettingRepository $settingRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
        $this->answerRepository = $answerRepository;
        $this->settingRepository = $settingRepository;
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
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Questionnaire crée !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $questionnaire = $this->questionnaireRepository->getQuestions($id);
        $questionnaires = $this->questionnaireRepository->getAll();
        $canRegister = $this->settingRepository->getByName("Activer l'enregistrement des utilisateurs");

        return view('quiz', compact('questionnaire', 'questionnaires', 'canRegister'));
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
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Questionnaire supprimé !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Status mise à jour !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }
}
