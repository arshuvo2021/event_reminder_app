<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    // Update the fillable property to match the actual database column
    protected $fillable = ['event_id', 'name', 'email'];  // Make sure to use 'email' instead of 'user_email'

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
