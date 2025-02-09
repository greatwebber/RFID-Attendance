<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('faculty')->get();
        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.department.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments',
            'faculty_id' => 'required|exists:faculties,id',
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department added successfully.');
    }

    public function edit(Department $department)
    {
        $faculties = Faculty::all();
        return view('admin.department.edit', compact('department', 'faculties'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $department->id,
            'faculty_id' => 'required|exists:faculties,id',
        ]);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}

