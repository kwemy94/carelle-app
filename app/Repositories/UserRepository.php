<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\ResourceRepository;

class UserRepository extends ResourceRepository {

    public function __construct(User $user) {
        $this->model = $user;
    }

    public function getById($id) {
        return $this->model->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->model->where('name','!=', 'admin')->orderBy('id', 'DESC')->get();
    }

}
