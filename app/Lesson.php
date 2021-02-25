<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lessons";
    protected $fillable = 
    [
        'subject_name', 'class_category'
    ];
}
