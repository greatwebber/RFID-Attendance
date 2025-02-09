<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RfidCard;
use App\Models\Student;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function index()
    {
        $rfidCards = RfidCard::with('student')->get();
        return view('admin.rfid.index', compact('rfidCards'));
    }

    public function create()
    {
        $students = Student::doesntHave('rfid')->get(); // Get students without RFID
        return view('admin.rfid.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rfid_number' => 'required|unique:rfid_cards',
            'student_id' => 'required|exists:students,id',
        ]);

        RfidCard::create($request->all());

        return redirect()->route('admin.rfid.index')->with('success', 'RFID assigned successfully.');
    }

    public function edit(RfidCard $rfid)
    {
        $students = Student::all();
        return view('admin.rfid.edit', compact('rfid', 'students'));
    }

    public function update(Request $request, RfidCard $rfid)
    {
        $request->validate([
            'rfid_number' => 'required|unique:rfid_cards,rfid_number,' . $rfid->id,
            'student_id' => 'required|exists:students,id',
        ]);

        $rfid->update($request->all());

        return redirect()->route('admin.rfid.index')->with('success', 'RFID updated successfully.');
    }

    public function destroy(RfidCard $rfid)
    {
        $rfid->delete();
        return redirect()->route('admin.rfid.index')->with('success', 'RFID deleted successfully.');
    }
}

