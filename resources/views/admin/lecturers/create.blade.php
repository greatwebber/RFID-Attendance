@extends('adminlte::page')

@section('title', 'Add Lecturer')

@section('content')
    <h1>Add Lecturer</h1>

    <form action="{{ route('lecturers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Lecturer Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <select class="form-control" id="department" name="department_id" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Lecturer</button>
        <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
