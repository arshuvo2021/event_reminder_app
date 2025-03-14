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
            'email' => 'required|email', // Ensure email is required and valid
        ]);

        $event = Event::findOrFail($eventId);

        $participant = new EventParticipant([
            'name' => $request->name,
            'email' => $request->email, // Ensure email is passed correctly
        ]);

        // Check if the app is offline (optional feature)
        if (request()->header('X-Offline') === 'true') {
            // Save participant data in local storage or database for offline syncing
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

    /**
     * Store the participant data offline in local storage or a database.
     * This will allow syncing when the app is back online.
     */
    private function storeOfflineParticipant($eventId, $name, $email)
    {
        // You can use localStorage on the frontend or IndexedDB for persistent offline storage
        // For now, we'll store it in a temporary file or database if you have a separate 'offline_participants' table.

        $offlineParticipant = new OfflineParticipant([
            'event_id' => $eventId,
            'name' => $name,
            'email' => $email,
        ]);

        // Save offline participant in a database table (if you choose to persist offline data)
        $offlineParticipant->save();
    }
}
