<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // 📌 Mark attendance via RFID/NFC
    public function markAttendance(Request $request)
    {
        $request->validate([
            'rfid_tag' => 'required|string',
            'session_id' => 'required|exists:attendance_sessions,id',
        ]);

        // Find student by RFID tag
        $student = Student::where('rfid_tag', $request->rfid_tag)->first();
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Check if session exists
        $session = AttendanceSession::findOrFail($request->session_id);
        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        // Check if the student is enrolled in this course
        if (!$student->courses->contains($session->course_id)) {
            return response()->json(['message' => 'Student not enrolled in this course'], 403);
        }

        // Mark attendance
        $attendance = Attendance::updateOrCreate(
            [
                'student_id' => $student->id,
                'session_id' => $session->id,
            ],
            [
                'status' => 'present',
            ]
        );

        return response()->json(['message' => 'Attendance marked successfully', 'attendance' => $attendance]);
    }

    // 📌 Get available attendance sessions for a course
    public function getAttendanceSessions($course_id)
    {
        $sessions = AttendanceSession::where('course_id', $course_id)->get();
        return response()->json($sessions);
    }

    // 📌 Get attendance records for a course
    public function getAttendanceRecords($course_id)
    {
        $records = Attendance::whereHas('session', function ($query) use ($course_id) {
            $query->where('course_id', $course_id);
        })->with(['student', 'session'])->get();

        return response()->json($records);
    }
}

