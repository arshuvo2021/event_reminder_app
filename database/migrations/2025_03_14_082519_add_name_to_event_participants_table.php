<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('event_participants', function (Blueprint $table) {
            $table->string('name')->after('event_id'); // Add name column
        });
    }
    
    public function down()
    {
        Schema::table('event_participants', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
    
};
