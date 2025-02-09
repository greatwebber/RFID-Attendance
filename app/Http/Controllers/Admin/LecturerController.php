<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Lecturer;
use App\Models\Course;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::all();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.lecturers.create',compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:lecturers',
            'phone' => 'nullable|string',
            'department_id' => 'required',
        ]);

        Lecturer::create($request->all());

        return redirect()->route('lecturers.index')->with('success', 'Lecturer added successfully');
    }

    public function edit(Lecturer $lecturer)
    {
        $departments = Department::all();
        return view('admin.lecturers.edit', compact('lecturer','departments'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:lecturers,email,' . $lecturer->id,
            'phone' => 'nullable|string',
            'department' => 'required|string',
        ]);

        $lecturer->update($request->all());

        return redirect()->route('lecturers.index')->with('success', 'Lecturer updated successfully');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer deleted successfully');
    }

    // Assign Courses to Lecturer
    public function assignCourses(Lecturer $lecturer)
    {
        $courses = Course::all();
        return view('admin.lecturers.assign-courses', compact('lecturer', 'courses'));
    }

    public function storeAssignedCourses(Request $request, Lecturer $lecturer)
    {
        $lecturer->courses()->sync($request->courses);
        return redirect()->route('lecturers.index')->with('success', 'Courses assigned successfully');
    }
}

