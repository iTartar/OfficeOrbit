<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ScheduleDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        
        $joinDate = Carbon::parse($user->joindate);
        $endDate = Carbon::parse($user->enddate);
        
        if (!$user->schedule_id) {
            return redirect()->route('schedule-user.index')
                ->with('error', 'User does not have an assigned schedule.');
        }

        // Get schedule details
        $scheduleDetails = ScheduleDetail::where('schedule_id', $user->schedule_id)->get();
        $shifts = $user->schedule->shifts;

        // Buat array untuk menyimpan semua shift dari joindate sampai enddate
        $loopshifts = [];
        $currentDate = $joinDate->copy();

        while ($currentDate <= $endDate) {
            foreach ($shifts as $shift) {
                $loopshifts[] = [
                    'id' => $shift->id,
                    'employee' => $shift->employee,
                    'date' => $currentDate->toDateString(),
                    'everyYear' => false,
                ];
            }
            $currentDate->addDay();
        }

        // dd($loopshifts);

        return view('calendar', [
            'user' => $user,
            // 'employee' => $employee,
            'shifts' => $shifts,
            'joindate' => $user->joindate,
            'enddate' => $user->enddate,
        ]);
    }
}