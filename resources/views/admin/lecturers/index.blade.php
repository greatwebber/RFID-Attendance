@extends('adminlte::page')

@section('content')
    <h1>Lecturers</h1>
    <a href="{{ route('lecturers.create') }}" class="btn btn-primary">Add Lecturer</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lecturers as $lecturer)
            <tr>
                <td>{{ $lecturer->name }}</td>
                <td>{{ $lecturer->email }}</td>
                <td>{{ $lecturer->department->name }}</td>
                <td>
                    <a href="{{ route('lecturers.edit', $lecturer) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('lecturers.assignCourses', $lecturer) }}" class="btn btn-info">Assign Courses</a>
                    <form action="{{ route('lecturers.destroy', $lecturer) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
