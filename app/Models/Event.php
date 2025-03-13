<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'description', 'event_reminder_id'];

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }
}
