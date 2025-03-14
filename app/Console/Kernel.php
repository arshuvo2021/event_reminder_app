<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\EventController;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        (new EventController)->sendReminderEmails();
    })->dailyAt('08:00'); // Adjust time as needed
}


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
