<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Lesson;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            return back()->withError(['error' => 'Make sure you fill your password']);
        }
    }

    public function dashboardadmin()
    {
        return view('admin.index',['count_ins' => User::where('role', 'instructor')->count()]);
    }

    public function user()
    {
        $users = User::where('role', 'instructor')->get();
        return view('admin.data', ['users' => $users]);
    }

    // protected function create(array $data)
    // {
    //     User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'gender' => $data['gender'],
    //         'phone' => $data['phone'],
    //         'role' => $data['role'],
    //     ]);
    //     return redirect('/user');
    // }

    public function create(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        return redirect('/user');
    }

    public function update(Request $request, $id)
    {
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
        User::destroy($id);
        return redirect('/user');
    }

    // public function destroy($id)
    // {
    //     $users = User::find($id);
    //     $users->delete();
    //     return redirect('/user')->with('statusDelete', 'Data Berhasil Dihapus!');
    // }
    // Data Lesson
    public function lesson()
    {
        $lesson = Lesson::all();
        return view('admin.lesson', ['lesson' => $lesson]);
    }

    public function create_lesson(Request $request)
    {
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
        $users->save();

        return back()->with('success', 'You have succeess in setting Your Profile');
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
            'image' => $name_file ,
            'video'=> $request->video
        ]);
        return redirect('/class');
    }

    public function update_class(Request $request, $id)
    {
        $image = $request->file('image');
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/image_class'), $name_file);

        $class = Classes::find($id);
        $class->category = $request->category;
        $class->deskripsi = $request->deskripsi;
        $class->image = $name_file;
        $class->video = $request->video;
        $class->save();

        $class = User::where('image')->get();
        return redirect('/class',['classes' => $class]);
    }
}
