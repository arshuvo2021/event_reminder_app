<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        \App\Http\Controllers\EventController::sendReminderEmails();
    })->everyMinute();  // You can adjust this interval as needed
}

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
