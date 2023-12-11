<?php

namespace App\Http\Controllers; // Make sure to include the correct namespace

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function getAttendance($employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $attendance = $employee->attendances;

        $totalWorkingHours = $attendance->sum(function ($record) {
            return strtotime($record->check_out) - strtotime($record->check_in);
        });

        return response()->json(['employee' => $employee, 'attendance' => $attendance, 'totalWorkingHours' => $totalWorkingHours]);
    }
}
