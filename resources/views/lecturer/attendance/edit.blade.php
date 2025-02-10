@extends('lecturer.layout')

@section('lecturer-content')
    <h2>Edit Attendance Session</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('lecturer.attendance.update', $session->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Select Course:</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $session->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->course_name }} ({{ $course->course_code }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Attendance Date & Time:</label>
            <input type="datetime-local" name="session_time" class="form-control" value="{{ $session->session_time }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Session</button>
    </form>
@endsection
