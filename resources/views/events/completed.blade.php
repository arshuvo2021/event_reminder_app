@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Completed Events</h2>

        @if($events->isEmpty())
            <p>No completed events.</p>
        @else
            <ul class="list-group">
                @foreach ($events as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->title }}</strong> - {{ $event->date }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
