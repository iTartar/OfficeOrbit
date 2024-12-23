<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $perPage = $request->input('per_page', 10); // Default 10 if no input
        // $users = User::paginate($perPage)->withPath('/user');
        $users = User::all();
        $orderColumn = request('order_column', 'nama');
        if (! in_array($orderColumn, ['id', 'namalengkap', 'nama'])) { 
            $orderColumn = 'nama';
        } 
        $orderDirection = request('order_direction', 'desc');
        if (! in_array($orderDirection, ['asc', 'desc'])) { 
            $orderDirection = 'desc';
        } 
        $users = User::query()
        ->when(request('search'), function (Builder $query) {
            $query->where('nama', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('namalengkap', 'like', '%' . request('search') . '%');
        })
        ->when(request('role'), function (Builder $query) {
            $query->where('role', request('role'));
        })
        ->orderBy($orderColumn, $orderDirection)
        ->paginate(10);
        
        if ($request->ajax()) {
            return view('user.table', compact('users','sort', 'direction'))->render();
        }
       
        return view('user', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'role' => 'nullable|in:Super_Admin,User',
            'progress' => 'nullable|integer',
            'value' => 'nullable|integer',
            'status' => 'nullable|integer',
            'ttl' => 'nullable|date',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'notelp' => 'nullable|string',
            'namalengkap' => 'nullable|string|max:255',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghucu',
            'joindate' => 'nullable|date',
            'enddate' => 'nullable|date',
        ]);
       
        User::create($validatedData);
        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable',
            'email' => 'nullable|unique:users,email,' . $user->id,
            'role' => 'nullable|in:Super_Admin,User',
            'progress' => 'nullable',
            'value' => 'nullable',
            'status' => 'nullable',
            'ttl' => 'nullable',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'notelp' => 'nullable',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghucu',
            'namalengkap' => 'nullable|string|max:255',
            'joindate' => 'nullable|date',
            'enddate' => 'nullable|date',


        ]);
       
        $user->update($validatedData);
        return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}