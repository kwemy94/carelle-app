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
            $quiz = $this->questionnaireRepository->getById($request->questionnaire_id);
            // dd($request->lines);
            if (is_null($request->lines) ) {
                $notification = array(
                    'message' => "Vous n'avez pas remplis le formulaire",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            if (count($request->lines) != count($quiz->questions)) {
                $notification = array(
                    'message' => "Tous les champs du formulaire sont obligataires",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            // dd($inputs,count($request->lines), count($quiz->questions));
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
            'message' => "Merci d'avoir répondu à notre quiz!",
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
                    $truePerception = 0;
                    $trueAttente = 0;
                    $trueImportaance = 0;
                    foreach (json_decode($answer->resultat) as $key => $value) {
                        $id = explode("_", $key);
                        $question = $this->questionRepository->getById($id[1]);

                        #tester si la question est dans la catégorie courrante
                        if ($question->category_id == $category->id) {
                            #tester si la réponse du client correspond à la réponse attendue
                            if ($question->response == $value) {
                                $som += $question->cotation;

                                #données de calcul du pourcentage P I et A
                                if($question->type == 1){
                                    $truePerception++;
                                }
                                if($question->type == 2){
                                    $trueAttente++;
                                }
                                if($question->type == 0){
                                    $trueImportaance++;
                                }
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
                    
                } else {
                    throw new Exception("Le client à soumis un formulaire vide");
                }
            }
            // dd($labels);
            $upCategory = $this->questionnaireRepository->updateCotation($answer->questionnaire->id);

            $nFS = 0;
            if($upCategory['perception'] != 0 && $upCategory['attente'] != 0 && $trueAttente != 0){
                $nFS = ($truePerception/$upCategory['perception'])*100/($trueAttente/$upCategory['attente']);
            }
            
            $nSR = 0;
            if($upCategory['importance'] != 0){
                $importance = $trueImportaance*100/$upCategory['importance'];
                $nSR = ($nFS/100) * $importance;
            }

            $dataNfs = [$nFS, $nSR];
            if ($bilan) {
                return [
                    'labels' => $labels,
                    'datas' => $datas,
                    'bgColor' => $bgColor,
                    'dataSolutions' => $dataSolutions,
                    'dataNfs'=> $dataNfs
                ];
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

        return view('admin.answer.show', compact('answer', 'dataSolutions', 'labels', 'datas', 'bgColor', 'nFS', 'nSR', 'dataNfs'));
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
        // $cpt = 0;
        // dd(count($questionnaire->answers));
        $somDataNfs = ['nfs'=>0, 'nsr'=>0];
        foreach ($questionnaire->answers as $answer) {
            $res = $this->show($answer->id, true);
            $labels = $res['labels'];
            $somDataNfs['nfs'] += $res['dataNfs'][0];
            $somDataNfs['nsr'] += $res['dataNfs'][1];
            // dump($cpt++, $answer->id);
            // if($cpt == 5) dd(2);
            for ($i = 0; $i < count($labels); $i++) {
                if (isset($datas[$i])) {
                    $datas[$i] += $res['datas'][$i];
                } else {
                    $datas[$i] = $res['datas'][$i];
                }
                
            }
        }
        $dataSolutions = $res['dataSolutions'];

        #prendre la moyenne des datas trouvée
        if ($totalAnswer > 0) {
            for ($i = 0; $i < count($datas); $i++) {
                $datas[$i] = $datas[$i] / $totalAnswer;
            }
            $dataNfs = [$somDataNfs['nfs']/$totalAnswer, $somDataNfs['nsr']/$totalAnswer];
        }

        return view('admin.rapport-general.show', compact('dataNfs','dataSolutions', 'questionnaire', 'labels', 'datas', 'answers', 'questionnaires'));
    }
}
