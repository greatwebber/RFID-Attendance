@extends('adminlte::page')

@section('content')
    <h1>Edit RFID Assignment</h1>

    <form action="{{ route('rfid.update', $rfid->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="rfid_number">RFID Number</label>
            <input type="text" name="rfid_number" class="form-control" value="{{ $rfid->rfid_number }}" required>
        </div>

        <div class="form-group">
            <label for="student_id">Select Student</label>
            <select name="student_id" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $rfid->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update RFID</button>
    </form>
@endsection
