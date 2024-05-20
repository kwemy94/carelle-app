<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
