<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailReminder extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'email', 'sent_at'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
