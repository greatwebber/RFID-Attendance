@extends('adminlte::page')

@section('title', 'Assign Courses to Lecturer')

@section('content_header')
    <h1>Assign Courses to {{ $lecturer->name }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('lecturers.assignCourses.store', $lecturer->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Select Courses:</label>
                    <select name="course_ids[]" class="form-control" multiple>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $lecturer->courses->contains($course->id) ? 'selected' : '' }}>
                                {{ $course->course_name }} ({{ $course->course_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Courses</button>
            </form>
        </div>
    </div>
@endsection
