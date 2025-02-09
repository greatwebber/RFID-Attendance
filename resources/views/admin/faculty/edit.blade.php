@extends('adminlte::page')

@section('title', 'Edit Faculty')

@section('content_header')
    <h1>Edit Faculty</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('faculties.update', $faculty->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Faculty Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $faculty->name }}" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
