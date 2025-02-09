@extends('adminlte::page')

@section('title', 'Register Student')

@section('content_header')
    <h1>Register Student</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="student_id" class="form-label">Student ID</label>
                    <input type="text" name="student_id" id="student_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="rfid_tag" class="form-label">RFID Tag (Optional)</label>
                    <input type="text" name="rfid_tag" id="rfid_tag" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="faculty_id" class="form-label">Faculty</label>
                    <select name="faculty_id" id="faculty_id" class="form-control" required>
                        <option value="">Select Faculty</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select name="department_id" id="department_id" class="form-control" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-control" required>
                        <option value="ND1">ND1</option>
                        <option value="ND2">ND2</option>
                        <option value="HND1">HND1</option>
                        <option value="HND2">HND2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Student Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Register</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
