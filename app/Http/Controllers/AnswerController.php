<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionnaireRepository;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    private $answerRepository;
    private $questionnaireRepository;

    public function __construct(AnswerRepository $answerRepository, QuestionnaireRepository $questionnaireRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->questionnaireRepository = $questionnaireRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = $this->answerRepository->getAll();
        $questionnaires = $this->questionnaireRepository->getAll(2);
        //  dd($answers);
        return view('admin.answer.index', compact('answers', 'questionnaires'));
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
        try {
            $inputs = $request->except('lines');
            $inputs['resultat'] = json_encode($request->lines);
            // dd($inputs);
            $this->answerRepository->store($inputs);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with(['success' => false, "message" => "une erreur s'est produite: "]);
        }
        return redirect()->route('home')->with(['success' => true, "message" => "Vos réponses ont été enregistrées!"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $answer = $this->answerRepository->getById($id);
            $answer->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['success' => false, "message" => "une erreur : " . $th->getMessage()]);
        }
        return redirect()->back()->with(['success' => true, "message" => "Réponse du quiz supprimée !"]);
    }
}
