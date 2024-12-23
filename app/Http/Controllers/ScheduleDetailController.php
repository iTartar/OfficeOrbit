<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Employee;
use App\Models\ScheduleDetail;
use Illuminate\Http\Request;

class ScheduleDetailController extends Controller
{
    public function show(Schedule $schedule)
    {
        $employees = Employee::all();
        
        $scheduleDetails = ScheduleDetail::where('schedule_id', $schedule->id)
            ->orderBy('date')
            ->get();
            
        return view('schedule.show', compact('schedule', 'scheduleDetails', 'employees'));
        
    }

    public function store(Request $request, Schedule $schedule)
    {
        // dd($request);
        $validated = $request->validate([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
        ]);

        ScheduleDetail::create([
            'schedule_id' => $request->schedule_id,
            'date' => $validated['date'],
            'employee_id' => $validated['employee_id'],
        ]);

        return redirect()->back()->with('success', 'Schedule detail added successfully');
    }

    public function update(Request $request, ScheduleDetail $scheduleDetail)
    {
        // dd($scheduleDetail);
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $scheduleDetail->update($validated);

        return redirect()->back()->with('success', 'Schedule detail updated successfully');
    }

    public function destroy(ScheduleDetail $scheduleDetail)
    {
        $scheduleDetail->delete();
        return redirect()->back()->with('success', 'Schedule detail deleted successfully');
    }
}