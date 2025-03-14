@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary">Event Reminder App</h2>

       <!-- Success Message -->
@if(session('success'))
<div id="success-message" class="alert alert-success mb-4">
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        let successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.transition = "opacity 0.5s";
            successMessage.style.opacity = "0";
            setTimeout(() => successMessage.remove(), 500); // Remove it after fade-out
        }
    }, 3000);
</script>
@endif


        <!-- Display Upcoming Events -->
        <h3 class="mt-4">Upcoming Events</h3>
        @if($upcomingEvents->isEmpty())
            <p>No upcoming events.</p>
        @else
            <div class="row">
                @foreach ($upcomingEvents as $event)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $event->date }}</h6>
                                <p class="card-text">Event Description or Brief Information goes here.</p>

                                <div class="text-center">
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm mx-1">Add Participant</a>
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Display Completed Events -->
        <h3 class="mt-4">Completed Events</h3>
        @if($completedEvents->isEmpty())
            <p>No completed events.</p>
        @else
            <div class="row">
                @foreach ($completedEvents as $event)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $event->date }}</h6>
                                <p class="card-text">Event Description or Brief Information goes here.</p>

                                <div class="text-center">
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm mx-1">Add Participant</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
