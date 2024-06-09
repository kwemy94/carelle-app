<?php

namespace App\Repositories;

use App\Models\Questionnaire;

// use App\Repositories\ResourceRepository;

class QuestionnaireRepository extends ResourceRepository
{

    public function __construct(Questionnaire $questionnaire)
    {
        $this->model = $questionnaire;
    }

    public function getById($id)
    {
        return $this->model->with('categories', 'questions')->where('id', $id)->first();
    }

    public function getAll($status = null)
    {
        if ($status) {
            $res = $this->model->orderBy('id', 'DESC')->get();
        } else {
            $res = $this->model->where('status', 1)->orderBy('id', 'DESC')->get();
        }
        return $res;
    }

    public function getQuestions($questionnaireId)
    {
        return $this->model
            ->where('id', $questionnaireId)
            ->with('categories', 'questions')
            ->first();
    }

    public function updateCotation($id)
    {
        // dump(1);
        $quiz = $this->getById($id);
        $perception = 0;
        $attente = 0;
        $importance = 0;

        foreach ($quiz->questions as $key => $question) {
            if ($question->type == 1) {
                $perception++;
            }
            if ($question->type == 0) {
                $importance++;
            }
            if ($question->type == 2) {
                $attente++;
            }
        }
        
        return [
            'cotationAttente'=> $attente != 0 ? 100/$attente : 0,
            'cotationPerception'=> $perception != 0 ? 100/$perception: 0,
            'cotationImportance'=>$importance != 0 ? 100/$importance: 0,
            'attente'=> $attente,
            'perception'=> $perception,
            'importance'=>$importance,
            'questions' => $quiz->questions,
        ];
    }

}
