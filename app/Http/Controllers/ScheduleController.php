<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Classes;

class ScheduleController extends Controller
{
    public function index(){
        $schedule = Schedule::all();
        $classes = Classes::all();
        return view('admin.schedule.index', compact('schedule', 'classes'));
    }

    public function create(Request $request){
        Schedule::create([
            'days' => $request->day,
            'type_conference' =>$request->tycon,
            'time' => $request->time,
            'class_category' => $request->class,
            'link_zoom' => $request->link,
            // 'due_date' => $request->due
        ]);

        return redirect('/schedule');
    }
    
    public function delete($id)
    {
        Schedule::destroy($id);
        return redirect('/schedule');
    }

    public function update(Request $request, $id){
        $update= Schedule::find($id);
        $update->type_conference= $request->type;
        $update->days = $request->day;
        $update->time = $request->time;
        $update->class_category = $request->class;
        $update->link_zoom = $request->link;
        // $update->due_date = $request->due;
        $update->save();

        return redirect('/schedule');
    }
}
