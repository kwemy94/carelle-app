<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\ResourceRepository;

class SettingRepository extends ResourceRepository {

    public function __construct(Setting $setting) {
        $this->model = $setting;
    }

    public function getById($id) {
        return $this->model->where('id', $id)->first();
    }

    public function getByName($name) {
        return $this->model->where('name', $name)->first();
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

}
