<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventReminderEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('event_reminder_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('email');
            $table->dateTime('reminder_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_reminder_emails');
    }
}
