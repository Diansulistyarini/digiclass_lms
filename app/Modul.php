<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = "moduls";
    protected $fillable = 
    [
        'basic_competencies','subject_matter','learning_moduls','video_tutorials','class_category','due_date'
    ];

    public function class()
    {
        return $this->hasMany('App\Classes', 'id', 'category');
    }
}
