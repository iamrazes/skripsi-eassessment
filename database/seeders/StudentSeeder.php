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
            'gender' => 'Male',
            'birthdate' => '2000-01-01',
            'student_id' => 'S12345',
            'classroom_id' => 1,
        ]);

        DataStudent::create([
            'user_id' => 5,
            'gender' => 'Female',
            'birthdate' => '2000-01-01',
            'student_id' => 'S12346',
            'classroom_id' => 4,
        ]);
    }
}
