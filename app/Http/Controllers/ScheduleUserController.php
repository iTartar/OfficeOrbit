<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleUserController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
         $perPage = $request->input('per_page', 10); // Default to 10 per page
        // $users = User::paginate($perPage);

        // $schedules = Schedule::all(); // Fetch all schedules from the database

        // return view('schedule_user', [
        //     'users' => $users,
        //     'schedules' => $schedules, // Pass the $schedules variable to the view
        // ]);

        $data['users'] = User::paginate($perPage);
        $data['schedules'] = Schedule::all();
        return view('schedule_user', $data);
    }

    public function assign(Request $request)
    {
 
        $user = User::find($request->user_id);
        $schedule = Schedule::find($request->schedule_id);
        $user->schedule_id = $schedule->id;
        // $user->schedule_name = $schedule->name;
        $user->save();
        
        return redirect()->back()->with('success', 'Schedule detail added successfully');
        // return response()->json(['success' => true]);
    }
}