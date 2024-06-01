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

        $student = User::create([
            'user_id' => 'student2',
            'name' => 'Student2',
            'email' => 'student2@example.com',
            'password' => Hash::make('student2'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student3',
            'name' => 'Student3',
            'email' => 'student3@example.com',
            'password' => Hash::make('student3'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student4',
            'name' => 'Student4',
            'email' => 'student4@example.com',
            'password' => Hash::make('student4'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student5',
            'name' => 'Student5',
            'email' => 'student5@example.com',
            'password' => Hash::make('student5'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student6',
            'name' => 'Student6',
            'email' => 'student6@example.com',
            'password' => Hash::make('student6'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student7',
            'name' => 'Student7',
            'email' => 'student7@example.com',
            'password' => Hash::make('student7'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student9',
            'name' => 'Student9',
            'email' => 'student9@example.com',
            'password' => Hash::make('student9'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student10',
            'name' => 'Student10',
            'email' => 'student10@example.com',
            'password' => Hash::make('student10'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student11',
            'name' => 'Student11',
            'email' => 'student11@example.com',
            'password' => Hash::make('student11'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
        $student = User::create([
            'user_id' => 'student12',
            'name' => 'Student12',
            'email' => 'student12@example.com',
            'password' => Hash::make('student12'),
            'email_verified_at' => now()
        ]);
        $student->syncRoles(['student']);
    }
}
