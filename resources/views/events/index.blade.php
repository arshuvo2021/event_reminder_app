@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Event Reminder App</h2>

        <!-- Button to Create Event -->
        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Upcoming Events Button -->
        <a href="{{ route('events.upcoming') }}" class="btn btn-info mb-3">Upcoming Events</a>

        <!-- Completed Events Button -->
        <a href="{{ route('events.completed') }}" class="btn btn-secondary mb-3">Completed Events</a>

        <!-- Display Upcoming Events -->
        <h3>Upcoming Events</h3>
        @if($upcomingEvents->isEmpty())
            <p>No upcoming events.</p>
        @else
            <ul class="list-group">
                @foreach ($upcomingEvents as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->title }}</strong> - {{ $event->date }}
                        
                        <!-- Add Participant Button -->
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">Add Participant</a>

                        <!-- Edit Event Button -->
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <!-- Delete Event Button -->
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Display Completed Events -->
        <h3 class="mt-4">Completed Events</h3>
        @if($completedEvents->isEmpty())
            <p>No completed events.</p>
        @else
            <ul class="list-group">
                @foreach ($completedEvents as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->title }}</strong> - {{ $event->date }}
                        
                        <!-- Add Participant Button -->
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">Add Participant</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
