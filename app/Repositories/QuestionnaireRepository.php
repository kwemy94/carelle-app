<?php

namespace App\Repositories;

use App\Models\Questionnaire;
// use App\Repositories\ResourceRepository;

class QuestionnaireRepository extends ResourceRepository {

    public function __construct(Questionnaire $questionnaire) {
        $this->model = $questionnaire;
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

    public function getQuestions($questionnaireId){
        return $this->model
            ->where('id', $questionnaireId)
            ->with('categories', 'questions')
            ->first();
    }

}
