@extends('lecturer.layout')

@section('lecturer-content')
    <h2>My Attendance Sessions</h2>

    <a href="{{ route('lecturer.attendance.create') }}" class="btn btn-primary">Create Attendance Session</a>
    <br><br>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>Course</th>
            <th>Course Code</th>
            <th>Session Time</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sessions as $session)
            <tr>
                <td>{{ $session->course->course_name }}</td>
                <td>{{ $session->course->course_code }}</td>
                <td>{{ $session->session_time }}</td>
                <td>
                    <a href="{{ route('lecturer.attendance.edit', $session->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('lecturer.attendance.destroy', $session->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this session?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
