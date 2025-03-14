You're right! Since the project doesn't explicitly use external APIs, the mention of API routes in the README was unnecessary. The app operates with Laravel routes and views, not through an API in the traditional sense.

I'll correct that in the README. Here's an updated version of the README that excludes the API routes and focuses on the actual routes and functionality of the app:

Event Reminder App

Overview

The Event Reminder App allows users to manage events, participants, and receive email reminders for upcoming events. The app includes features like event CRUD operations, adding participants, sending email reminders, and importing events from CSV files.

Features

Event management (create, update, delete, view).

Add participants to events.

Send email reminders to participants.

Import events from CSV.

Upcoming and completed event views.

Scheduled email reminders.

Requirements

PHP 8.0 or higher

Composer

MySQL

Laravel 8.x or higher

SMTP configuration for sending emails

Installation

1. Clone the repository

git clone https://github.com/yourusername/event-reminder-app.git
cd event-reminder-app


2. Install dependencies

Run the following command to install the necessary dependencies using Composer:

composer install


3. Set up environment variables

Duplicate the .env.example file and rename it to .env. Then, update the .env file with your own database and email settings.

cp .env.example .env


Configure your MySQL database connection.

Set up SMTP settings for email reminders (use Gmail SMTP or your preferred service).

Example:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_reminder
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Event Reminder App"


4. Generate application key

php artisan key:generate


5. Run migrations

Run the following command to create the necessary database tables:

php artisan migrate


6. Set up the scheduler

Make sure that the Laravel scheduler is running to trigger email reminders. Open your app/Console/Kernel.php file and verify that the sendReminderEmails function is scheduled to run every minute:

protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        (new \App\Http\Controllers\EventController)->sendReminderEmails();
    })->everyMinute();
}


To test locally, you can run the scheduler manually:

php artisan schedule:run


You may also want to set up a cron job on your server to run this command every minute.

Usage

Accessing the App

Once everything is set up, you can access the app via:

http://localhost:8000


Use the following routes for different functionalities:

Home Page: /

Create Event: /events/create

View Events: /events

Show Event Details: /events/{id}

Add Participant: /events/{id}/participants (POST request)

CSV Import: /events/import (via file upload)

Sending Email Reminders

Email reminders will be sent automatically to participants 1 day before the event. You can trigger the email reminders manually for testing by running the following command in Tinker:

php artisan tinker
(new App\Http\Controllers\EventController)->sendReminderEmails();




