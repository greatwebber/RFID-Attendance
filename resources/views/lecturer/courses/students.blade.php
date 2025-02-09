@extends('lecturer.layout')

@section('lecturer-content')
    <div class="">
        <h2>Students Enrolled in {{ $course->name }} ({{ $course->code }})</h2>
        <a href="{{ route('lecturer.courses') }}" class="btn btn-secondary mb-3">Back to Courses</a>

        @if($course->students->isNotEmpty())  {{-- Fix null error --}}
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Level</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->level }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No students enrolled in this course.</p>
        @endif
    </div>
@endsection
