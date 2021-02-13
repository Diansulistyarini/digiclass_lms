<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardadmin()
    {
        return view('admin.index', ['count_admin' => User::where('role', 'admin')->count()]);
    }

    public function user()
    {
    	$users = User::all();
    	return view('admin.data', ['users' => $users]);
    }
}
