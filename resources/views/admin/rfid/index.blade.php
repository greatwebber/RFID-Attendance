@extends('adminlte::page')

@section('content')
    <h1>RFID Management</h1>
    <a href="{{ route('rfid.create') }}" class="btn btn-primary">Assign New RFID</a>

    <table class="table">
        <thead>
        <tr>
            <th>RFID Number</th>
            <th>Student</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rfidCards as $rfid)
            <tr>
                <td>{{ $rfid->rfid_number }}</td>
                <td>{{ $rfid->student->name }}</td>
                <td>
                    <a href="{{ route('rfid.edit', $rfid->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('rfid.destroy', $rfid->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
