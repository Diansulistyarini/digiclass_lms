<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardadmin()
    {
        return view('admin.index', ['count_ins' => User::where('role', 'instructor')->count()]);
    }

    public function user()
    {
    	$users = User::where('role', 'instructor')->get();
    	return view('admin.data', ['users' => $users]);
    }

    public function create(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        return redirect('/user');
    }

    public function update(Request $request,$id)
    {
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->role = $request->role;
        $users->save();
        
        return redirect('/user');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect('/user')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
    // Data Lesson
    public function lesson()
    {
    	$lesson = Lesson::all();
    	return view('admin.lesson', ['lesson' => $lesson]);
    }

    public function create_lesson(Request $request){
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
}
