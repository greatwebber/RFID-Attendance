@extends('adminlte::page')

@section('title', 'Student List')

@section('content_header')
    <h1>Student List</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" width="50" height="50" class="rounded-circle">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->faculty->name }}</td>
                        <td>{{ $student->department->name }}</td>
                        <td>{{ $student->level }}</td>
                        <td>
                            @if($student->rfid_tag)
                                <span class="badge bg-success">{{ $student->rfid_tag }}</span>
                                <a href="{{ route('students.print-rfid', $student->id) }}" class="btn btn-secondary btn-sm">
                                    Print RFID
                                </a>
                            @else
                                <a href="{{ route('students.generate-rfid', $student->id) }}" class="btn btn-primary btn-sm">
                                    Generate RFID
                                </a>
                            @endif


                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info btn-sm">Edit</a>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $students->links() }}
        </div>
    </div>
@endsection
