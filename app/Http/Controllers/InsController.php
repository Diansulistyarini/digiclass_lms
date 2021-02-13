<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsController extends Controller
{
    public function dashboardins()
    {
        return view('ins.dashboardins');
    }
}
