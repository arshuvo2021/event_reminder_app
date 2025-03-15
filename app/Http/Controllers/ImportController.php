<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EventsImport;

class ImportController extends Controller
{
    public function showImportForm()
    {
        return view('events.import'); 
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        \Log::info('File received: ', [$request->file('file')->getClientOriginalName()]);

        Excel::import(new EventsImport, $request->file('file')); 

        \Log::info('Import completed');

        return redirect()->route('events.index')->with('success', 'Events imported successfully!');
    }
}
