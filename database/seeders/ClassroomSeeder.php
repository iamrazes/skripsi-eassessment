<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        $classroomNames = ['10 A', '11 A', '12 A', '10 B', '11 B', '12 B', '10 C', '11 C', '12 C'];

        foreach ($classroomNames as $name) {
            Classroom::create([
                'name' => $name,
            ]);
        }
    }
}
