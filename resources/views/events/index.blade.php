@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Event Reminder App</h2>

        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h3>Upcoming Events</h3>
        @if($upcomingEvents->isEmpty())
            <p>No upcoming events.</p>
        @else
            <ul class="list-group">
                @foreach ($upcomingEvents as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->title }}</strong> - {{ $event->date }}
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <h3 class="mt-4">Completed Events</h3>
        @if($completedEvents->isEmpty())
            <p>No completed events.</p>
        @else
            <ul class="list-group">
                @foreach ($completedEvents as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->title }}</strong> - {{ $event->date }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
