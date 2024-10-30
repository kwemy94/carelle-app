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

    public function updateCotation($categoryId)
    {
        // dump(1);
        $category = $this->getById($categoryId);
        $perception = 0;
        $attente = 0;
        $importance = 0;

        foreach ($category->questions as  $question) {
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
            'category' => $category,
        ];
    }

    

}
