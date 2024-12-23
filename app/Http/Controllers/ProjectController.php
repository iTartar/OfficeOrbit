<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 if no input
        $projects = Project::with('user')->paginate($perPage)->withPath('/project');
        $users = User::all();

        $orderColumn = request('order_column', 'projek');
        if (! in_array($orderColumn, ['id', 'priority', 'projek'])) { 
            $orderColumn = 'projek';
        } 
        $orderDirection = request('order_direction', 'desc');
        if (! in_array($orderDirection, ['asc', 'desc'])) { 
            $orderDirection = 'desc';
        } 
        
        $projects = Project::query()
        ->when(request('search'), function (Builder $query) {
            $query->where('projek', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('priority', 'like', '%' . request('search') . '%');
        })
        ->when(request('end_date'), function (Builder $query) {
            $query->where('end_date', request('start_date'));
        })
        ->orderBy($orderColumn, $orderDirection)
        ->paginate(10);
        
        if ($request->ajax()) {
            return view('project.table', compact('projects'))->render();
        }
       
        return view('project', compact('users', 'projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'projek' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value' => 'nullable|string|max:100000',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:planning,ongoing,completed,on_hold',
        ]);

        Project::create($validatedData);

        return redirect()->route('project.index')->with('success', 'Project created successfully.');
    }


    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'projek' => 'nullable|string|max:255',
            'progress' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'value' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:planning,ongoing,completed,on_hold',
        ]);
        
        $project->update($validatedData);
        return redirect()->route('project.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Project deleted successfully.');
    }
}
