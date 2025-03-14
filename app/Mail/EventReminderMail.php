<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $participants;

    /**
     * Create a new message instance.
     *
     * @param Event $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
        // Load participants for the event
        $this->participants = $event->participants;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
{
    return $this->subject('Event Reminder: ' . $this->event->title)
                ->view('emails.event_reminder')
                ->with([
                    'event' => $this->event,
                ]);
}

}
