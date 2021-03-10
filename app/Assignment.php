<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table="penugasans";
    protected $fillable=
    [
        'name','class_category','subject_matter','online_text','file','date','score'
    ];
}
