<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $reminderTime;

    /**
     * Create a new message instance.
     *
     * @param Event $event
     * @param string $reminderTime
     */
    public function __construct($event, $reminderTime)
    {
        $this->event = $event;
        $this->reminderTime = $reminderTime;
    }
    
    public function build()
    {
        return $this->subject('Event Reminder')
                    ->view('emails.eventReminder')
                    ->with([
                        'event' => $this->event,
                        'reminder_time' => $this->reminderTime,
                    ]);
    }
    
}