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

        $student1 = User::create([
            'username' => 'student',
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('student'),
            'email_verified_at' => now()
        ]);
        $student1->syncRoles(['student']);

        DataStudent::create([
            'user_id' => 3,
            'gender' => 'Male',  // Replace with actual gender data
            'birthdate' => '2000-01-01',  // Replace with actual birthdate data
            'student_id' => 'S12345',  // Replace with actual student ID data
            'classroom_id' => 1,  // Uncomment and replace with actual classroom ID if needed
        ]);

        $student2 = User::create([
            'username' => 'student2',
            'name' => 'Student2',
            'email' => 'student2@example.com',
            'password' => Hash::make('student2'),
            'email_verified_at' => now()
        ]);
        $student2->syncRoles(['student']);

        DataStudent::create([
            'user_id' => 4,
            'gender' => 'Female',  // Replace with actual gender data
            'birthdate' => '2000-01-01',  // Replace with actual birthdate data
            'student_id' => 'S12346',  // Replace with actual student ID data
            'classroom_id' => 1,  // Uncomment and replace with actual classroom ID if needed
        ]);
    }
}
