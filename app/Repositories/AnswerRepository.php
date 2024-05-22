<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Repositories\ResourceRepository;

class AnswerRepository extends ResourceRepository {

    public function __construct(Answer $answer) {
        $this->model = $answer;
    }

    public function getById($id) {
        return $this->model->with('questionnaire')->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->model->with('questionnaire')->orderBy('id', 'DESC')->get();
    }

}
