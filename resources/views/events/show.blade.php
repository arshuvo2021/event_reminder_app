@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">{{ $event->title }}</h2>
        <p>{{ $event->description }}</p>
        <p><strong>Date:</strong> {{ $event->date }}</p>

        <!-- Add Participant Form -->
        <h3>Add Participant</h3>
        <form action="{{ route('participants.store', $event->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Add Participant</button>
        </form>

        <!-- List of Participants -->
        <h3 class="mt-4">Participants</h3>
        @if($event->participants->isEmpty())
            <p>No participants yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event->participants as $participant)
                        <tr>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>
                                <!-- Delete Participant Button -->
                                <form action="{{ route('participants.destroy', [$event->id, $participant->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
