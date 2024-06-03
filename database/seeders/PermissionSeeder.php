<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'admin-access']);
        Permission::create(['name' => 'teacher-access']);
        Permission::create(['name' => 'student-access']);

        $actions = ['create', 'read', 'update', 'delete'];
        $entities = ['permissions', 'roles', 'users', 'admins'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                $permissionName = "{$entity}-{$action}";
                Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
            }
        }
    }
}
