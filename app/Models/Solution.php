<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsToMany(Category::class)->withPivot('marge_inf', 'marge_sup');
    }
}
