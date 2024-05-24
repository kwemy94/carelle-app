<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\UserRepository;

class DashboardController extends Controller
{
    private $questionnaireRepository;
    private $answerRepository;
    private $userRepository;
    public function __construct(QuestionnaireRepository $questionnaireRepository,
            AnswerRepository $answerRepository, UserRepository $userRepository){
        $this->questionnaireRepository = $questionnaireRepository;
        $this->answerRepository = $answerRepository;
        $this->userRepository = $userRepository;
    }

    public function dashboard(){
        $questionnaires = $this->questionnaireRepository->getAll(2);
        $publishQuestionnaires = $this->questionnaireRepository->getAll();

        $responseQuestionnaire = $this->answerRepository->getAll();
        $answers = $this->answerRepository->getAll();
        $users = $this->userRepository->getAll();

        return view('dashboard', compact('users', 'questionnaires','publishQuestionnaires', 'responseQuestionnaire','answers'));
    }
}
