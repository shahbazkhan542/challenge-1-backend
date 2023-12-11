<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;

class ExcelController extends Controller
{
    public function uploadAttendance(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');

        // Store the Excel file in a temporary location
        $filePath = $file->storeAs('temp', $file->getClientOriginalName(), 'local');

        // Import the Excel file data using Laravel Excel
        $import = new AttendanceImport();
        Excel::import($import, storage_path('app/temp/' . $file->getClientOriginalName()));

        // You can now access the imported data through $import->getData()

        // Optionally, move the file to a permanent location or delete it
        // Storage::move("temp/{$file->getClientOriginalName()}", "uploads/{$file->getClientOriginalName()}");
        // Storage::delete("temp/{$file->getClientOriginalName()}");

        return response()->json(['message' => 'Attendance data uploaded successfully']);
    }
}

