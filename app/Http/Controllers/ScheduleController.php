<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 if no input
        $schedules = Schedule::paginate($perPage)->withPath('/schedule');
        $schedules = Schedule::all();

        $orderColumn = request('order_column', 'name');
        if (! in_array($orderColumn, ['id', 'name', 'effective_Date'])) { 
            $orderColumn = 'effective_date';
        } 
        $orderDirection = request('order_direction', 'desc');
        if (! in_array($orderDirection, ['asc', 'desc'])) { 
            $orderDirection = 'desc';
        }
        $schedules = Schedule::query()
        ->when(request('search'), function (Builder $query) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('effective_date', 'like', '%' . request('search') . '%')
                ->orWhere('type', 'like', '%' . request('search') . '%');
        })
        ->when(request('effective_date'), function (Builder $query) {
            $query->where('effective_date', request('name'));
        })
        ->orderBy($orderColumn, $orderDirection)
        ->paginate(10);
        
        if ($request->ajax()) {
            return view('schedule.table', compact('schedules'))->render();
        }
        return view('schedule', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'effective_date' => 'required|date',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedule.index')->with('success', 'Schedule berhasil ditambahkan.');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'name' => 'required',
            'effective_date' => 'required|date',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedule.index')->with('success', 'Schedule berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedule.index')->with('success', 'Schedule berhasil dihapus.');
    }

    public function show(Schedule $schedule)
    {
        return view('schedule.show', compact('schedule'));
    }

    public function addShift(Schedule $schedule, Request $request)
    {
        $schedule->shifts()->create([
            'date' => $request->date,
            'type' => null  // Tidak ada tipe default
        ]);
        return response()->json(['message' => 'Shift added successfully']);
    }
}