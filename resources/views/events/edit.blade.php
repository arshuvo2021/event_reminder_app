@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Event</h1>

        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ $event->date }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $event->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">Update Event</button>
        </form>
    </div>
@endsection
