<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        return view('admin.faculty.index', compact('faculties'));
    }

    public function create()
    {
        return view('admin.faculty.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:faculties']);
        Faculty::create($request->all());
        return redirect()->route('faculties.index')->with('success', 'Faculty added successfully.');
    }

    public function edit(Faculty $faculty)
    {
        return view('admin.faculty.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $request->validate(['name' => 'required|unique:faculties,name,' . $faculty->id]);
        $faculty->update($request->all());
        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Faculty deleted successfully.');
    }
}
