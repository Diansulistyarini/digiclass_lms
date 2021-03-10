<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;

class InsController extends Controller
{
    public function dashboardins()
    {
        return view('ins.index');
    }

    public function class()
    {
        $classes = Classes::all();
        return view('ins.classes', ['classes' => $classes]);
    }
}
