<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::create([
            'user_id' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now()
        ]);
        $admin->syncRoles(['admin']);

        $teacher = User::create([
            'user_id' => 'teacher',
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('teacher'),
            'email_verified_at' => now()
        ]);
        $teacher->syncRoles(['teacher']);

        $student = User::create([
            'user_id' => 'student',
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('student'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
    }
}
