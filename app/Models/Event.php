<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'description', 'event_reminder_id'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->event_reminder_id)) {
                $event->event_reminder_id = 'EVT-' . strtoupper(uniqid());
            }
        });
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }
}
