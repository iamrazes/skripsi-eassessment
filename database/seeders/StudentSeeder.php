<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataStudent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DataStudent::create([
            'user_id' => 4,
            'gender' => 'Male',  // Replace with actual gender data
            'birthdate' => '2000-01-01',  // Replace with actual birthdate data
            'student_id' => 'S12345',  // Replace with actual student ID data
            'classroom_id' => 1,  // Uncomment and replace with actual classroom ID if needed
        ]);

        DataStudent::create([
            'user_id' => 5,
            'gender' => 'Female',  // Replace with actual gender data
            'birthdate' => '2000-01-01',  // Replace with actual birthdate data
            'student_id' => 'S12346',  // Replace with actual student ID data
            'classroom_id' => 1,  // Uncomment and replace with actual classroom ID if needed
        ]);
    }
}
