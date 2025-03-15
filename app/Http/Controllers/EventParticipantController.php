<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    public function store(Request $request, $eventId)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email', 
        ]);

        $event = Event::findOrFail($eventId);

        $participant = new EventParticipant([
            'name' => $request->name,
            'email' => $request->email, 
        ]);

        if (request()->header('X-Offline') === 'true') {
            $this->storeOfflineParticipant($eventId, $request->name, $request->email);
            return response()->json(['message' => 'Participant saved locally. Will sync once online.'], 200);
        }

        // Save the participant if online
        $event->participants()->save($participant);

        return redirect()->route('events.show', $eventId)->with('success', 'Participant added successfully.');
    }

    public function destroy(Event $event, EventParticipant $participant)
    {
        $participant->delete();

        return redirect()->route('events.show', $event->id)->with('success', 'Participant removed successfully.');
    }

    
    private function storeOfflineParticipant($eventId, $name, $email)
    {
        $offlineParticipant = new OfflineParticipant([
            'event_id' => $eventId,
            'name' => $name,
            'email' => $email,
        ]);

        $offlineParticipant->save();
    }
}
