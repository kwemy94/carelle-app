<?php

namespace App\Repositories;

use App\Models\Solution;
use App\Repositories\ResourceRepository;

class SolutionRepository extends ResourceRepository {

    public function __construct(Solution $solution) {
        $this->model = $solution;
    }

    public function getAll() 
    {
        return $this->model->with('category')->orderBy('id', 'DESC')->get();
    }
    public function getById($id) {
        return $this->model->with('category')->where('id', $id)->first();
    }

}
