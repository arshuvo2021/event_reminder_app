<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $upcomingEvents = Event::where('date', '>=', $today)->orderBy('date', 'asc')->get();
        $completedEvents = Event::where('date', '<', $today)->orderBy('date', 'desc')->get();

        return view('events.index', compact('upcomingEvents', 'completedEvents'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request, $eventId)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email', // Ensure email is required and valid
    ]);

    // Debug the request data using dd to ensure it's coming through correctly
    dd($request->all());  // Remove after confirming data is correct

    // Find the event by ID
    $event = Event::findOrFail($eventId);

    // Create a new participant and save it
    $participant = new EventParticipant([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // Save the participant to the event's participants relationship
    $event->participants()->save($participant);

    // Redirect with a success message
    return redirect()->route('events.show', $eventId)->with('success', 'Participant added successfully.');
}

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function upcoming()
{
    $events = Event::where('date', '>=', Carbon::today())->orderBy('date')->get();
    return view('events.upcoming', compact('events'));
}

public function completed()
{
    $events = Event::where('date', '<', Carbon::today())->orderBy('date', 'desc')->get();
    return view('events.completed', compact('events'));
}

}
