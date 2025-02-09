@extends('adminlte::page')

@section('title', 'Add Faculty')

@section('content_header')
    <h1>Add Faculty</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('faculties.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Faculty Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
