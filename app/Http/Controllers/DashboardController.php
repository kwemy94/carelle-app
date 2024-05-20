<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionnaireRepository;

class DashboardController extends Controller
{
    private $questionnaireRepository;
    public function __construct(QuestionnaireRepository $questionnaireRepository){
        $this->questionnaireRepository = $questionnaireRepository;
    }

    public function dashboard(){
        $questionnaires = $this->questionnaireRepository->getAll();

        return view('dashboard', compact('questionnaires'));
    }
}
