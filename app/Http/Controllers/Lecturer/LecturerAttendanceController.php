<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerAttendanceController extends Controller
{
    //

    public function create()
    {
        $lecturer = Auth::guard('lecturer')->user();
        $courses = $lecturer->courses; // Only show assigned courses

        return view('lecturer.attendance.create', compact('courses'));
    }

    // Store attendance session
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'session_time' => 'required|date',
        ]);

        $lecturer = Auth::guard('lecturer')->user();

        // Ensure the lecturer is assigned to this course
        if (!$lecturer->courses()->where('course_id', $request->course_id)->exists()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        AttendanceSession::create([
            'lecturer_id' => $lecturer->id,
            'course_id' => $request->course_id,
            'session_time' => $request->session_time,
        ]);

        return redirect()->route('lecturer.attendance.index')->with('success', 'Attendance session created');
    }

    // Show list of attendance sessions
    public function index()
    {
        $lecturer = Auth::guard('lecturer')->user();
        $sessions = AttendanceSession::where('lecturer_id', $lecturer->id)->with('course')->get();

        return view('lecturer.attendance.index', compact('sessions'));
    }

    public function viewAttendance(Request $request, $course_id)
    {
        $lecturer = Auth::guard('lecturer')->user();

        // Ensure the lecturer is assigned to this course
        $course = $lecturer->courses()->where('courses.id', $course_id)->first();
        if (!$course) {
            abort(403, 'Unauthorized access');
        }

        // Fetch attendance records with filters
        $query = Attendance::whereHas('session', function ($q) use ($course_id) {
            $q->where('course_id', $course_id);
        })->with(['student', 'session']);

        // Apply date filter
        if ($request->has('date') && !empty($request->date)) {
            $query->whereHas('session', function ($q) use ($request) {
                $q->whereDate('session_time', $request->date);
            });
        }

        // Apply level filter (ND1, ND2, HND1, HND2)
        if ($request->has('level') && !empty($request->level)) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('level', $request->level);
            });
        }

        // Apply student name filter
        if ($request->has('student_name') && !empty($request->student_name)) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%');
            });
        }

        $attendanceRecords = $query->get();

        return view('lecturer.attendance.record', compact('course', 'attendanceRecords'));
    }




    public function edit(AttendanceSession $session)
    {
        $lecturer = Auth::guard('lecturer')->user();

        // Ensure the lecturer owns this session
        if ($session->lecturer_id !== $lecturer->id) {
            return redirect()->route('lecturer.attendance.index')->with('error', 'Unauthorized access.');
        }

        $courses = $lecturer->courses; // Get lecturer's assigned courses

        return view('lecturer.attendance.edit', compact('session', 'courses'));
    }

    public function update(Request $request, AttendanceSession $session)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'session_time' => 'required|date',
        ]);

        $lecturer = Auth::guard('lecturer')->user();

        // Ensure the lecturer owns this session
        if ($session->lecturer_id !== $lecturer->id) {
            return redirect()->route('lecturer.attendance.index')->with('error', 'Unauthorized access.');
        }

        $session->update([
            'course_id' => $request->course_id,
            'session_time' => $request->session_time,
        ]);

        return redirect()->route('lecturer.attendance.index')->with('success', 'Attendance session updated successfully.');
    }

    public function destroy(AttendanceSession $session)
    {
        $lecturer = Auth::guard('lecturer')->user();

        // Ensure the lecturer owns this session
        if ($session->lecturer_id !== $lecturer->id) {
            return redirect()->route('lecturer.attendance.index')->with('error', 'Unauthorized access.');
        }

        $session->delete();

        return redirect()->route('lecturer.attendance.index')->with('success', 'Attendance session deleted successfully.');
    }


}
