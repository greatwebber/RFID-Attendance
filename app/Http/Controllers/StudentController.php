<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
//use Milon\Barcode\DNS1D;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('faculty', 'department')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('admin.students.create', compact('faculties', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'student_id' => 'required|unique:students',
            'faculty_id' => 'required|exists:faculties,id',
            'department_id' => 'required|exists:departments,id',
            'level' => 'required|in:ND1,ND2,HND1,HND2',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Upload Photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }

        // Store Student
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'rfid_tag' => $request->rfid_tag,
            'faculty_id' => $request->faculty_id,
            'department_id' => $request->department_id,
            'level' => $request->level,
            'photo' => $photoPath,
        ]);

        return redirect()->route('students.index')->with('success', 'Student registered successfully!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('admin.students.edit', compact('student', 'faculties', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$id,
            'student_id' => 'required|unique:students,student_id,'.$id,
            'faculty_id' => 'required|exists:faculties,id',
            'department_id' => 'required|exists:departments,id',
            'level' => 'required|in:ND1,ND2,HND1,HND2',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Handle Photo Update
        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::delete('public/' . $student->photo);
            }
            $photoPath = $request->file('photo')->store('students', 'public');
            $student->photo = $photoPath;
        }

        // Update Student
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'rfid_tag' => $request->rfid_tag,
            'faculty_id' => $request->faculty_id,
            'department_id' => $request->department_id,
            'level' => $request->level,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function generateRFID($id)
    {
        $student = Student::findOrFail($id);

        // Generate a Unique RFID ID
        $rfid = strtoupper(Str::random(10));

        // Assign RFID to Student
        $student->update(['rfid_tag' => $rfid]);

        return redirect()->route('students.index')->with('success', 'RFID assigned successfully!');
    }

    public function printRFID($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.rfid_card', compact('student'));
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        // Delete Photo
        if ($student->photo) {
            Storage::delete('public/' . $student->photo);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

}

