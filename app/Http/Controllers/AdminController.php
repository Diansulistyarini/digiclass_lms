<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Lesson;
use App\User;
use App\Modul;
use App\Schedule;
use Barryvdh\DomPDF\Facade as PDF;
// use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function changeview()
    {
        return view('admin.updatepw');
    }

    public function updatepw()
    {
        request()->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $currentPassword = auth()->user()->password;
        $old_password = request('old_password');

        if (Hash::check($old_password, $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt(request('password')),
            ]);

            return back()->with('success', 'You are changed your password');
        } else {
            return back()->withError(['error', 'Make sure you fill your password']);
        }
    }

    public function dashboardadmin()
    {
        $countStudent = User::where('role', 'student')->count();
        $countInstructor = User::where('role', 'instructor')->count();
        $countJadwal = Schedule::all()->count();
        $countClass = Classes::all()->count();
        $jadwals = Schedule::all();
        $classes = Classes::all();
        return view('admin.index', compact('countStudent', 'countInstructor', 'countJadwal', 'countClass', 'jadwals', 'classes' ));
    }

    public function user()
    {
        $users = User::where('role', 'instructor')->get();
        return view('admin.data', ['users' => $users]);
    }

    public function create(Request $request)
    {
        Session::flash('sukses','Successfully Adding Data');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        return redirect('/user');
    }

    public function update(Request $request, $id)
    {
        Session::flash('sukses','Successfully Changed Data');
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->gender = $request->gender;
        $users->phone = $request->phone;
        $users->role = $request->role;
        $users->save();

        return redirect('/user');
    }

    public function destroy($id)
    {
        Session::flash('sukses','Successfully Delete Data');
        User::destroy($id);
        return redirect('/user');
    }

    // Data Lesson
    public function lesson()
    {
        $lesson = Lesson::all();
        return view('admin.lesson', ['lesson' => $lesson]);
    }

    public function create_lesson(Request $request)
    {
        Session::flash('sukses','Successfully Adding Data');
        Lesson::create([
            'subject_name' => $request->subject_name,
            'class_category' => $request->class_category
        ]);
        return redirect('/lesson');
    }

    public function update_lesson(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        $lesson->subject_name = $request->subject_name;
        $lesson->class_category = $request->class_category;
        $lesson->save();
        return redirect('/lesson');
    }

    public function destroy_lesson($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect('/lesson');
    }

    public function view_profile()
    {
        $nama = Auth::user()->name;
        $users = User::where('name', $nama)->get();
        return view('admin.viewprofile', ['users' => $users]);
        
    }

    public function update_profile(Request $request, $id)
    {
        $photo = $request->file('photo');
        $name_file = $photo->getClientOriginalName();
        $photo->move(base_path('/public/photo'), $name_file);

        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->gender = $request->gender;
        $users->photo = $name_file;
        // $users->class = $request->class;
        $users->save();
        
        Session::flash('sukses','You have succeess in setting Your Profile');
        return back();
        // return back()->with('success', 'You have succeess in setting Your Profile');
    }

    // Classes
    public function classes()
    {
        $classes = Classes::all();
        return view('admin.classes.index', ['classes' => $classes]);
    }

    public function delete_class($id)
    {
        Classes::destroy($id);
        return redirect('/class');
    }

    public function create_class(Request $request){
        $image = $request->file('image');
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/image_class'), $name_file);
        Classes::create([
            'category' => $request->category,
            'deskripsi' => $request->deskripsi,
            'name_ins' => $request->name_ins,
            'image' => $name_file ,
            'video'=> $request->video
        ]);
        Session::flash('sukses','Successfully Adding Data');
        return redirect('/class');
    }

    public function update_class(Request $request, $id)
    {
        Session::flash('sukses','Successfully Changed Data');
        $image = $request->file('image');
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/image_class'), $name_file);

        $class = Classes::find($id);
        $class->category = $request->category;
        $class->deskripsi = $request->deskripsi;
        $class->name_ins = $request->name_ins;
        $class->image = $name_file;
        $class->video = $request->video;
        $class->save();
        
        return redirect('/class');
    }

    public function show($category)
    {
        $classes = Classes::all();
        $users = DB::select("SELECT * FROM `users` WHERE role = 'student' AND class = '$category' ");
        return view('admin.dataSiswas', compact('users', 'classes'));
    }   

    public function modul()
    {
        $modul = Modul::all();
        return view('admin.modul.index', ['modul'=>$modul]);
    }

    public function createModul(Request $request)
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
        Session::flash('sukses','Successfully Adding Data');
        return redirect('/moduls');
    }

    public function deleteModul($id)
    {
        Modul::destroy($id);
        return redirect('/moduls');
    }

    public function updateModul(Request $request, $id)
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

        return redirect('/moduls');
    }

    // Cetak PDF
    public function cetak_pdfIns()
    {
    	$users = User::where('role', 'instructor')->get();
    	$pdf = PDF::loadview('admin.pdf.dataIns_pdf',['users'=>$users]);
        // return $pdf->stream();
    	return $pdf->download('laporan-Data_Instructor.pdf');
    }

    public function cetak_pdfMember($category)
    {
        $class = User::find($category);
        // $class = User::where('class', $category);
        $users = DB::select("SELECT * FROM `users` WHERE role = 'student' AND class = '$class' ");
    	$pdf = PDF::loadview('admin.pdf.dataMember_pdf',['users'=>$users]);
    	// return $pdf->download('laporan-Data_Member.pdf');

        return $pdf->stream();
    }
}
