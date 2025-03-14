<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email', // Ensure email validation is added
        ]);
    
        $event = Event::findOrFail($eventId);
    
        $participant = new EventParticipant([
            'name' => $request->name,
            'email' => $request->email,  // Ensure email is passed correctly
        ]);
    
        $event->participants()->save($participant);
    
        return redirect()->route('events.show', $eventId)->with('success', 'Participant added successfully.');
    }
    
    public function destroy(Event $event, EventParticipant $participant)
    {
        $participant->delete();

        return redirect()->route('events.show', $event->id)->with('success', 'Participant removed successfully.');
    }
}
