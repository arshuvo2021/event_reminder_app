<?php


namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class EventsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info('Importing row: ', $row); // Log to confirm correct keys

        return new Event([
            'event_reminder_id' => 'EVT-' . Str::upper(Str::random(12)),
            'title'             => $row['title'] ?? null,
            'date'              => $row['date'] ?? null,
            'description'       => $row['description'] ?? null,
        ]);
    }
}
