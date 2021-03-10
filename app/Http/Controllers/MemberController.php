<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;

class MemberController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('pengguna.index', ['classes' => $classes]);
    }
}
