@extends('adminlte::page')

@section('title', 'Edit Course')

@section('content')
    <h1>Edit Course</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="{{ $course->course_name }}" required>
        </div>

        <div class="form-group">
            <label for="course_code">Course Code</label>
            <input type="text" class="form-control" id="course_code" name="course_code" value="{{ $course->course_code }}" required>
        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select class="form-control" id="department_id" name="department_id" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" @if($course->department_id == $department->id) selected @endif>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="level">Course Level</label>
            <select name="level" class="form-control" required>
                <option value="ND1" {{ $course->level == 'ND1' ? 'selected' : '' }}>ND1</option>
                <option value="ND2" {{ $course->level == 'ND2' ? 'selected' : '' }}>ND2</option>
                <option value="HND1" {{ $course->level == 'HND1' ? 'selected' : '' }}>HND1</option>
                <option value="HND2" {{ $course->level == 'HND2' ? 'selected' : '' }}>HND2</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
