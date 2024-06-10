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
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now()
        ]);
        $admin->syncRoles(['admin']);

        $teacher = User::create([
            'username' => 'teacher',
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('teacher'),
            'email_verified_at' => now()
        ]);
        $teacher->syncRoles(['teacher']);

        $student = User::create([
            'username' => 'student',
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('student'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
    }
}
