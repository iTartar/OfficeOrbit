<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->input('per_page', 10);
        $planning = Project::where('status', 'planning')->count();
        $completed = Project::where('status', 'completed')->count();
        $laki = User::where('gender', 'Male')->count();
        $perempuan = User::where('gender', 'Female')->count();
        $users = User::paginate($perpage);
        $projects = Project::paginate($perpage);
    
        return view('dashboard', compact('users', 'projects', 'planning', 'completed', 'laki', 'perempuan'));
    }
}