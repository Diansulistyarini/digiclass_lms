<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment;
use App\Modul;
use Carbon;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    // user 
    public function formsand($id)
    {
        $modul = Modul::where('id', $id)->get();
        return view('pengguna.upload_ass', ['modul'=>$modul]);
    }

    public function listuser()
    {
        $user = Auth::user()->name;
        $ass = Assignment::where('name', $user)->get();
        return view('pengguna.listass', ['ass'=>$ass]);
    }

    public function index()
    {
        $ass = Assignment::all();
        return view('admin.assignment.index',['ass'=>$ass]);
    }

    public function create( Request $request)
    {
        // Penugasan
        $file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
		$tujuan_upload = 'tugas_siswa';
        $file->move($tujuan_upload,$nama_file);

        Assignment::create([
            'name'=> $request->name,
            'class_category' => $request->class,
            'subject_matter' => $request->subject,
            'online_text' => $request->online,
            'file'=> $nama_file,
            'date' => Carbon\Carbon::now()
,
        ]);
        return redirect('/listass');
    }

    public function delete($id)
    {
        Assignment::destroy($id);
        return redirect('/assignment');
    }

    public function update(Request $request, $id){

        // Penugasan
        // $file = $request->file('file');
 
		// $nama_file = time()."_".$file->getClientOriginalName();
 
		// $tujuan_upload = 'tugas_siswa';
        // $file->move($tujuan_upload,$nama_file);


        $update = Assignment::find($id);
        $update->name= $request->name;
        $update->class_category = $request->class;
        $update->subject_matter = $request->subject;
        $update->online_text = $request->online;
        // $update->file = $nama_file;
        $update->date = $request->due;
        $update->score = $request->score;
        $update->save();

        return redirect('/assignment');
    }

    
}


