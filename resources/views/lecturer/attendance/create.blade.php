@extends('lecturer.layout')

@section('lecturer-content')
    <h2>Create Attendance Session</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('lecturer.attendance.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Select Course:</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Attendance Date & Time:</label>
            <input type="datetime-local" name="session_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Session</button>
    </form>
@endsection
