<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerCourseController extends Controller
{
    //

    public function assignCourses($lecturerId)
    {
        $lecturer = Lecturer::findOrFail($lecturerId);
        $courses = Course::where('department_id', $lecturer->department_id)->get(); // Only show courses in the same department
        return view('admin.lecturers.assign_courses', compact('lecturer', 'courses'));
    }

    public function storeAssignedCourses(Request $request, $lecturerId)
    {
        $lecturer = Lecturer::findOrFail($lecturerId);
        $lecturer->courses()->sync($request->input('course_ids', [])); // Sync courses
        return redirect()->route('lecturers.index')->with('success', 'Courses assigned successfully');
    }
}
