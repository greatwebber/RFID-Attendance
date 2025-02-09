@extends('adminlte::page')

@section('content')
    <h1>Assign RFID to Student</h1>

    <form action="{{ route('rfid.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rfid_number">RFID Number</label>
            <input type="text" name="rfid_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="student_id">Select Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Assign RFID</button>
    </form>
@endsection
