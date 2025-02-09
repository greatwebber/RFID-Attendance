@extends('adminlte::page')

@section('title', 'Courses')

@section('content')
    <h1>Courses</h1>

    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Add New Course</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Department</th>
            <th>Level</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($courses as $key => $course)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->department->name }}</td>
                <td>{{ $course->level }}</td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
