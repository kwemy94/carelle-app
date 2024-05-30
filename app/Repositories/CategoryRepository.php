<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\ResourceRepository;

class CategoryRepository extends ResourceRepository {

    public function __construct(Category $category) {
        $this->model = $category;
    }

    public function getById($id) {
        return $this->model->with('questions','questionnaire', 'solutions')->where('id', $id)->first();
    }

    public function getAll() 
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }
    public function getCategoryByQuiz($id)
    {
        return $this->model->where('questionnaire_id', $id)->with('solution')->orderBy('id', 'DESC')->get();
    }

    // public function getByCategory($categoryI)

}
