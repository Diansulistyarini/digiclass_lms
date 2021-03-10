<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = "instansis";
    protected $fillable =[
        'id', 'instansi', 'person', 'addres'
    ];
}
