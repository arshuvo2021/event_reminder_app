<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ImportController;
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

// Events CRUD
Route::resource('events', EventController::class);
