<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "jadwals";
    protected $fillable=
    [
        'days','type_conference', 'time','class_category','link_zoom','due_date'
    ];
}
