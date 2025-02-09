<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //

    public function index()
    {
        $totalStudents = Student::count();
        $totalDepartments = Department::count();
        $totalFaculty = Faculty::count();
//        $todayAttendance = Attendance::whereDate('created_at', today())->count();
//        $feesCollected = FeesPayment::sum('amount') ?? 100.0;
        $feesCollected =  100.0;

//        return view('admin.dashboard',compact('feesCollected'));

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalDepartments',
            'totalFaculty',
            'feesCollected'
        ));
    }
}
