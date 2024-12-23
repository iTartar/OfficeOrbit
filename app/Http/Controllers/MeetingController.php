<?php

namespace App\Http\Controllers;


use App\Models\Meeting;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 jika tidak ada input
        $meetings = meeting::paginate($perPage)->withPath('/meeting');

        $users = User::all();
        $firstUser  = $users->get(0);
        $secondUser  = $users->get(1);
        $combinedNames = 'No users found';
    
        if ($users->count() >= 2) {
            $firstUser = $users->first();
            $secondUser = $users->slice(1, 1)->first();
            
            // Add null checks
            if ($firstUser && $secondUser) {
                // Check if 'nama' property exists
                $firstName = $firstUser->nama ?? $firstUser->name ?? 'User 1';
                $secondName = $secondUser->nama ?? $secondUser->name ?? 'User 2';
                
                $combinedNames = "{$firstName}, {$secondName}";
            }
        }

        $projects=Project::all();
        $orderColumn = request('order_column', 'title');
        if (! in_array($orderColumn, ['id', 'date', 'title'])) { 
            $orderColumn = 'title';
        } 
        $orderDirection = request('order_direction', 'desc');
        if (! in_array($orderDirection, ['asc', 'desc'])) { 
            $orderDirection = 'desc';
        } 
        $users = User::query()
        ->when(request('search'), function (Builder $query) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('date', 'like', '%' . request('search') . '%')
                ->orWhere('time', 'like', '%' . request('search') . '%');
        })
        ->when(request('status'), function (Builder $query) {
            $query->where('status', request('status'));
        })
        ->orderBy($orderColumn, $orderDirection)
        ->paginate(10);
        if ($request->ajax()) {
            return view('meeting.table', compact('meetings'))->render();
        }
        
        return view('meeting', compact('meetings','users', 'projects','combinedNames'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,in_progress,completed,cancelled',
        ]);

        meeting::create($request->all());

        return redirect()->route('meeting.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, meeting $meeting)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,in_progress,completed,cancelled',
        ]);


        $meeting->update($request->all());

        return redirect()->route('meeting.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(meeting $meeting)
    {
        $meeting->delete();

        return redirect()->route('meeting.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}