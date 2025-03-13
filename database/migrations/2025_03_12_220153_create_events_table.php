<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('event_reminder_id')->unique()->nullable(); // Allow it to be generated dynamically
        $table->string('title');
        $table->date('date');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('events');
    }
}
