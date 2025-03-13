@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Event List</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Event</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->event_reminder_id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date }}</td>
                        <td>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
