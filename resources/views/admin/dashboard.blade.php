@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <!-- Total Students -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalStudents ?? '' }}</h3>
                    <p>Total Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>

        <!-- Total Departments -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalFaculty ?? '' }}</h3>
                    <p>Total Faculty</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalDepartments ?? '' }}</h3>
                    <p>Total Departments</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>

        <!-- Today's Attendance -->
{{--        <div class="col-lg-3 col-6">--}}
{{--            <div class="small-box bg-warning">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{ $todayAttendance ?? '' }}</h3>--}}
{{--                    <p>Today's Attendance</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-id-card"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Fees Collected -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>${{ number_format($feesCollected ?? '', 2) }}</h3>
                    <p>Fees Collected</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
