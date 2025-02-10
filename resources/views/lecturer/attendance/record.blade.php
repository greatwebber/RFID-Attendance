@extends('lecturer.layout')

@section('lecturer-content')
    <h2>Attendance Records for {{ $course->course_name }} ({{ $course->course_code }})</h2>
    <a href="{{ route('lecturer.courses') }}" class="btn btn-secondary mb-3">Back to Courses</a>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('lecturer.attendance.view', $course->id) }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <label for="date">Date:</label>
                <input type="date" name="date" value="{{ request('date') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="level">Level:</label>
                <select name="level" class="form-control">
                    <option value="">-- Select Level --</option>
                    <option value="ND1" {{ request('level') == 'ND1' ? 'selected' : '' }}>ND1</option>
                    <option value="ND2" {{ request('level') == 'ND2' ? 'selected' : '' }}>ND2</option>
                    <option value="HND1" {{ request('level') == 'HND1' ? 'selected' : '' }}>HND1</option>
                    <option value="HND2" {{ request('level') == 'HND2' ? 'selected' : '' }}>HND2</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="student_name">Student Name:</label>
                <input type="text" name="student_name" value="{{ request('student_name') }}" class="form-control" placeholder="Enter student name">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('lecturer.attendance.view', $course->id) }}" class="btn btn-secondary ml-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Attendance Table -->
    @if($attendanceRecords->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Level</th>
                <th>Session Time</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendanceRecords as $record)
                <tr>
                    <td>{{ $record->student->name }}</td>
                    <td>{{ $record->student->student_id }}</td>
                    <td>{{ $record->student->level }}</td>
                    <td>{{ $record->session->session_time }}</td>
                    <td>
                        @if($record->status == 'present')
                            <span class="badge badge-success">Present</span>
                        @else
                            <span class="badge badge-danger">Absent</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">No attendance records found.</p>
    @endif
@endsection
