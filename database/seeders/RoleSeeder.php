<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        // Fetch permissions
        $adminAccess = Permission::where('name', 'admin-access')->first();
        $teacherAccess = Permission::where('name', 'teacher-access')->first();
        $studentAccess = Permission::where('name', 'student-access')->first();

        // Sync permissions with roles
        $adminRole->syncPermissions([$adminAccess]);
        $teacherRole->syncPermissions([$teacherAccess]);
        $studentRole->syncPermissions([$studentAccess]);

    }
}
