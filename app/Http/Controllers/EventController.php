<?php

namespace App\Http\Controllers;

use App\Mail\EventReminderEmail;  
use App\Models\Event;
use App\Models\EventReminderEmail as ReminderEmailModel;  
use App\Models\EventParticipant; 
use App\Models\EmailReminder;
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

        $event = Event::findOrFail($eventId);

        $participant = new EventParticipant([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $event->participants()->save($participant);

        // Set up the email reminder time to 1 day before the event
        $reminderTime = Carbon::parse($event->date)->subDay();

        // Create reminder entry for the participant
        ReminderEmailModel::create([
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

    // Send reminder emails to participants based on the reminder time
    public function sendReminderEmails()
{
    $reminders = EmailReminder::with('event')
        ->whereNull('sent_at') // Only send emails that haven't been sent
        ->whereHas('event', function ($query) {
            $query->where('date', '=', now()->toDateString()); // Send on event day
        })
        ->get();

    foreach ($reminders as $reminder) {
        Mail::to($reminder->email)->send(new EventReminderEmail($reminder->event));

        // Mark email as sent
        $reminder->update(['sent_at' => now()]);
    }

    return response()->json(['message' => 'Reminder emails sent successfully.']);
}


    // Sync events (for importing events from external sources)
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
