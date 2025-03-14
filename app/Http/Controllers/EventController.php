<?php

namespace App\Http\Controllers;

use App\Mail\EventReminderEmail;  // Correct import statement
use App\Models\Event;
use App\Models\EventReminderEmail as ReminderEmailModel;  // Import the model for reminders if needed
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function storeParticipant(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Find the event by ID
        $event = Event::findOrFail($eventId);

        // Create a new participant and save it
        $participant = new EventParticipant([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Save the participant to the event's participants relationship
        $event->participants()->save($participant);

        // Set up the email reminder time to 1 day before the event
        $reminderTime = Carbon::parse($event->date)->subDay();

        // Create reminder entry for the participant
        EventReminderEmail::create([
            'event_id' => $event->id,
            'email' => $participant->email,
            'reminder_time' => $reminderTime,
        ]);

        return redirect()->route('events.show', $eventId)->with('success', 'Participant added and reminder set.');
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

 

   public function sendReminderEmails()
    {
        // Retrieve all reminder emails with events
        $reminderEmails = ReminderEmailModel::with('event')->where('reminder_time', '<=', now())->get();

        foreach ($reminderEmails as $reminderEmail) {
            // Send the reminder email to each recipient
            Mail::to($reminderEmail->email)->send(new EventReminderEmail($reminderEmail->event, $reminderEmail->reminder_time));
        }

        // Return a response after sending reminders
        return response()->json(['message' => 'Reminder emails sent successfully.']);
    }

    public function syncEvents(Request $request)
{
    $eventsData = $request->all();

    // Loop through the events data and save them to the database
    foreach ($eventsData as $eventData) {
        Event::create([
            'title' => $eventData['title'],
            'date' => $eventData['date'],
            'description' => $eventData['description'],
        ]);
    }

    return response()->json(['message' => 'Events synced successfully!']);
}


}
