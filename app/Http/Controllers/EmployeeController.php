<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 jika tidak ada input
        $employees = Employee::paginate($perPage)->withPath('/employee');
        $users=User::all();
        if ($request->ajax()) {
            return view('employee.table', compact('employees'))->render();
        }
        
        return view('employee', compact('employees','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required',
        ]);

        Employee::create($request->all());

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required',
        ]);

        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}