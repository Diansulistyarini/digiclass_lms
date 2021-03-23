<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;
use App\Modul;

class ModulController extends Controller
{
    public function index()
    {
        $modul = Modul::all();
        $class = Classes::all();
        // return echo($modul);
        // echo ($modul);
        return view('admin.modul.index', compact('modul', 'class'));
    }

    // List Modul
    public function list()
    {
        $modul = Modul::all();
        return view('pengguna.modulblade.list_modul', ['modul' => $modul]);
    }

    public function listdetail($id)
    {
        $modul = Modul::where('id', $id)->get();
        return view('pengguna.modulblade.modulslihat', ['modul' => $modul]);
        // echo($modul);
    }

    public function create(Request $request)
    {
        // learning
        $file = $request->file('learning');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        $tujuan_upload = 'modul';
        $file->move($tujuan_upload, $nama_file);

        Modul::create([
            'basic_competencies' => $request->basic,
            'subject_matter' => $request->subject,
            'learning_moduls' => $nama_file,
            'video_tutorials' => $request->video,
            'class_category' => $request->class,
            'due_date' => $request->due
        ]);

        return redirect(('/moduled'));
    }

    public function delete($id)
    {
        Modul::destroy($id);
        return redirect(('/moduled'));
    }

    public function update(Request $request, $id)
    {
        // learning
        $file = $request->file('learning');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        $tujuan_upload = 'modul';
        $file->move($tujuan_upload, $nama_file);

        $update = Modul::find($id);
        $update->basic_competencies = $request->basic;
        $update->subject_matter = $request->subject;
        $update->learning_moduls = $nama_file;
        $update->video_tutorials = $request->video;
        $update->class_category = $request->class;
        $update->due_date = $request->due;
        $update->save();

        return redirect('/moduled');
    }
}
