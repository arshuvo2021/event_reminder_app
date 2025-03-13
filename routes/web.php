<?php


use App\Http\Controllers\EventController;
use App\Http\Controllers\ImportController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('events.index');
});

// Custom import routes
Route::get('events/import', [ImportController::class, 'showImportForm'])->name('events.import');
Route::post('events/import', [ImportController::class, 'import'])->name('events.import.store');

Route::resource('events', EventController::class);
