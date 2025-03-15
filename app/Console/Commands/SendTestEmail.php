<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminderEmail;  

class SendTestEmail extends Command
{
    protected $signature = 'send:test-email';
    protected $description = 'Send a test email to verify email functionality';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = 'test@example.com'; // The recipient email address
        $event = 'Sample Event';     

        // Send the test email
        Mail::to($email)->send(new EventReminderEmail($event));

        $this->info('Test email sent successfully!');
    }
}
