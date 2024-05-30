<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Repositories\AnswerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\SolutionRepository;
use Exception;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    private $answerRepository;
    private $questionnaireRepository;
    private $questionRepository;
    private $categoryRepository;
    private $solutionRepository;

    public function __construct(
        AnswerRepository $answerRepository,
        QuestionnaireRepository $questionnaireRepository,
        QuestionRepository $questionRepository,
        CategoryRepository $categoryRepository,
        SolutionRepository $solutionRepository
    ) {
        $this->answerRepository = $answerRepository;
        $this->questionnaireRepository = $questionnaireRepository;
        $this->questionRepository = $questionRepository;
        $this->categoryRepository = $categoryRepository;
        $this->solutionRepository = $solutionRepository;
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
            errorManager("Store answer : ", $th, $th);
            $notification = array(
                'message' => "une erreur s'est produite",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => "Merci d'avoir répondu au quiz!",
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show($id, $bilan = false)
    {
        $answer = $this->answerRepository->getById($id);
        $questionnaire = $this->questionnaireRepository->getById($answer->questionnaire->id);
        
        #creation du tableau des labels du graph
        $labels = [];
        $datas = [];
        $dataSolutions = [];
        try {
            foreach ($questionnaire->categories as $category) {
                $labels = array_merge($labels, [$category->name]);
                // dd($category);
                #calcul de la valeur de chaque catégory et construire les datas
                $som = 0; 
                if (json_decode($answer->resultat)) {
                    foreach (json_decode($answer->resultat) as $key => $value) {
                        $id = explode("_", $key);
                        $question = $this->questionRepository->getById($id[1]);

                        #tester si la question est dans la catégorie courrante
                        if ($question->category_id == $category->id) {
                            #tester si la réponse du client correspond à la réponse attendue
                            if ($question->response == $value) {
                                $som += $question->cotation;
                            }
                        }
                    }
                    $datas = array_merge($datas, [$som]);

                    #recupérer la solution qui cadre avec la réponse
                    $cat = $this->categoryRepository->getById($category->id);
                    // dump($datas);
                    if ($cat->solutions) {
                        foreach ($cat->solutions as $solution) {
                            // dump($som,$solution->pivot->marge_inf, $solution->pivot->marge_sup);
                            if($solution->pivot->marge_inf < $som && $som <= $solution->pivot->marge_sup ){
                                $dataSolutions = array_merge($dataSolutions, [$category->name => $solution->intitule.' : '.$solution->description]);
                            }
                        }
                    }else{
                        $dataSolutions = array_merge($dataSolutions, ["Faites une analyse manuel de ce résultat"]);
                    }
                    
                    # Construction du tableau des couleurs
                    $bgColor = [];
                    $val = 10;
                    foreach ($labels as $key => $value) {
                        $val += $key + 8;
                        $bgColor = array_merge($bgColor, ["rgb(255, $val, $val)"]);
                    }
                    
                    if ($bilan) {
                        return [$labels, $datas, $bgColor, $dataSolutions];
                    }
                } else {
                    throw new Exception("Le client à soumis un formulaire vide");
                }

            }
            // dd($dataSolutions);
        } catch (Exception $th) {
            errorManager("listing bilan : ", $th, $th);
            $notification = array(
                'message' => "" . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        return view('admin.answer.show', compact('answer', 'dataSolutions', 'labels', 'datas', 'bgColor'));
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
            $notification = array(
                'message' => "Supprimer réponse quiz ! " . $th->getMessage(),
                'alert-type' => 'error'
            );
            errorManager("listing bilan : ", $th, $th);
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Réponse supprimée !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function IndexGeneralReport()
    {
        $answers = $this->answerRepository->getAll();

        #Questionnaires au status publié
        $questionnaires = $this->questionnaireRepository->getAll();

        return view('admin.rapport-general.index', compact('questionnaires', 'answers'));
    }
    public function generalReport($id)
    {
        $answers = $this->answerRepository->getAll();
        $questionnaires = $this->questionnaireRepository->getAll(2);

        $questionnaire = $this->questionnaireRepository->getById($id);

        $totalAnswer = count($questionnaire->answers);

        $labels = [];
        $datas = array();
        foreach ($questionnaire->answers as $answer) {
            $res = $this->show($answer->id, true);
            $labels = $res[0];

            for ($i = 0; $i < count($res[1]); $i++) {
                if (isset($datas[$i])) {
                    $datas[$i] += $res[1][$i];
                } else {
                    $datas[$i] = $res[1][$i];
                }

            }
        }

        #prendre la moyenne des datas trouvée
        if ($totalAnswer > 0) {
            for ($i = 0; $i < count($datas); $i++) {
                $datas[$i] = $datas[$i] / $totalAnswer;
            }
        }

        return view('admin.rapport-general.show', compact('questionnaire', 'labels', 'datas', 'answers', 'questionnaires'));
    }
}
