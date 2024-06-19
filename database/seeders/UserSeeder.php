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

        $teacher = User::create([
            'username' => 'teacher',
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('teacher'),
            'email_verified_at' => now()
        ]);
        $teacher->syncRoles(['teacher']);

        DataTeacher::create([
            'user_id' => 2,
            'contact' => '0895635903620',
            'address' => 'St. A12',
            'teacher_id' => 'T7854398',
        ]);
    }
}
