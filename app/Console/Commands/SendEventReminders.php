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
    protected $description = 'Send email reminders for upcoming events';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $events = Event::where('date', $tomorrow)->get();

        foreach ($events as $event) {
            Mail::to('user@example.com')->send(new EventReminderMail($event));
        }

        $this->info('Event reminders sent successfully.');
    }
}
