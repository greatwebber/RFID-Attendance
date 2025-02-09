@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
    <h1>Edit Student</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ $student->email }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="student_id" class="form-label">Student ID</label>
                    <input type="text" name="student_id" value="{{ $student->student_id }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="rfid_tag" class="form-label">RFID Tag</label>
                    <input type="text" name="rfid_tag" value="{{ $student->rfid_tag }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="faculty_id" class="form-label">Faculty</label>
                    <select name="faculty_id" class="form-control" required>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $faculty->id == $student->faculty_id ? 'selected' : '' }}>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select name="department_id" class="form-control" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $student->department_id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" class="form-control" required>
                        <option value="ND1" {{ $student->level == 'ND1' ? 'selected' : '' }}>ND1</option>
                        <option value="ND2" {{ $student->level == 'ND2' ? 'selected' : '' }}>ND2</option>
                        <option value="HND1" {{ $student->level == 'HND1' ? 'selected' : '' }}>HND1</option>
                        <option value="HND2" {{ $student->level == 'HND2' ? 'selected' : '' }}>HND2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Student Photo</label>
                    <input type="file" name="photo" class="form-control">
                    @if($student->photo)
                        <img src="{{ asset('storage/' . $student->photo) }}" width="80" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
