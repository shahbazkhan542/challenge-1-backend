<?php

namespace Database\Seeders;

// database/seeders/AttendanceSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        // Assuming you have an employee with ID 1 (adjust as needed)
        $employeeId = 1;

        // Generate sample attendance records
        for ($i = 0; $i < 5; $i++) {
            $checkIn = now()->subHours(rand(1, 24));
            $checkOut = $checkIn->copy()->addHours(rand(1, 8));

            DB::table('attendances')->insert([
                'employee_id' => $employeeId,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

