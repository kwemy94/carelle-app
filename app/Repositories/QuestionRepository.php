<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\ResourceRepository;

class QuestionRepository extends ResourceRepository {

    public function __construct(Question $question) {
        $this->model = $question;
    }

    public function getAll() 
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

}
