<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataAdmin;
use App\Models\DataTeacher;
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

        DataAdmin::create([
            'user_id' => 1,
            'contact' => '0895635903620',
            'address' => 'St. A12',
            'admin_id' => 'A7854398',
        ]);

        $teacher1 = User::create([
            'username' => 'teacher',
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('teacher'),
            'email_verified_at' => now()
        ]);
        $teacher1->syncRoles(['teacher']);

        $teacher2 = User::create([
            'username' => 'teacher2',
            'name' => 'Teacher2',
            'email' => 'teacher2@example.com',
            'password' => Hash::make('teacher2'),
            'email_verified_at' => now()
        ]);
        $teacher2->syncRoles(['teacher']);

        $student1 = User::create([
            'username' => 'student',
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('student'),
            'email_verified_at' => now()
        ]);
        $student1->syncRoles(['student']);


        $student2 = User::create([
            'username' => 'student2',
            'name' => 'Student2',
            'email' => 'student2@example.com',
            'password' => Hash::make('student2'),
            'email_verified_at' => now()
        ]);
        $student2->syncRoles(['student']);
    }
}
