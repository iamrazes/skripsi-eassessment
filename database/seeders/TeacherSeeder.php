<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataTeacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DataTeacher::create([
            'user_id' => 2,
            'contact' => '0895635903620',
            'address' => 'St. A12',
            'teacher_id' => 'T7854398',
        ]);

        DataTeacher::create([
            'user_id' => 3,
            'contact' => '0895635903620',
            'address' => 'St. A12',
            'teacher_id' => 'T7854398',
        ]);
    }
}
