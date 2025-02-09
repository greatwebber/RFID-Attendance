@extends('adminlte::page')

@section('title', 'Faculties')

@section('content_header')
    <h1>Faculties</h1>
@endsection

@section('content')
    <a href="{{ route('faculties.create') }}" class="btn btn-primary mb-3">Add Faculty</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Faculty Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($faculties as $faculty)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $faculty->name }}</td>
                <td>
                    <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
