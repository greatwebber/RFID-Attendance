@extends('adminlte::page')

@section('title', 'Print RFID Card')

@section('content_header')
    <h1>RFID Card - {{ $student->name }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body text-center">
            <h3>{{ $student->name }}</h3>
            <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
            <p><strong>RFID Tag:</strong> {{ $student->rfid_tag }}</p>
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($student->rfid_tag, 'C128') }}" alt="RFID Barcode">
            <br><br>
            <button onclick="window.print()" class="btn btn-primary">Print RFID Card</button>
        </div>
    </div>
@endsection
