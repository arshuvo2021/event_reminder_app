<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\EventParticipantController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('events.index');
});

// Import Routes (Leave as they are)
Route::get('events/import', [ImportController::class, 'showImportForm'])->name('events.import');
Route::post('events/import', [ImportController::class, 'import'])->name('events.import.store');

// Upcoming and Completed Routes
Route::get('/events/upcoming', [EventController::class, 'upcoming'])->name('events.upcoming');
Route::get('/events/completed', [EventController::class, 'completed'])->name('events.completed');

Route::post('events/{event}/participants', [EventParticipantController::class, 'store'])->name('participants.store');
Route::delete('events/{event}/participants/{participant}', [EventParticipantController::class, 'destroy'])->name('participants.destroy');

// Events CRUD
Route::resource('events', EventController::class);
