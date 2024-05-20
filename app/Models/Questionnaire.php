<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Questionnaire extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(Question::class, Category::class);
    }
}
