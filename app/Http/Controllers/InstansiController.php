<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::all();
        return view('admin.instansi.index', ['int' => $instansi]);
    }

    public function delete($id)
    {
        Instansi::destroy($id);
        return redirect('/instansi');
    }

    public function create(Request $request){
        Instansi::create([
            'instansi' => $request->name,
            'person' => $request->person,
            'addres'=> $request->add
        ]);
        return redirect('/instansi');
    }
}
