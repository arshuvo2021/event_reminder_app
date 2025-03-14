<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Mail\EventReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send email reminders for events happening tomorrow';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        
        $events = Event::where('date', $tomorrow)->get();

        foreach ($events as $event) {
            $recipients = ['user@example.com'];  

            foreach ($recipients as $email) {
                try {
                    Mail::to($email)->send(new EventReminderMail($event));
                } catch (\Exception $e) {
                    $this->error("Failed to send reminder for event: {$event->title} to {$email}. Error: " . $e->getMessage());
                }
            }

            $this->info("Reminder sent for event: {$event->title}");
        }

        $this->info('Event reminders sent successfully!');
    }
}
