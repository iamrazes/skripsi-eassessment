<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        // Array of subject names
        $subjectNames = [
            'Mathematics',
            'Science',
            'History',
            'English',
            'Geography',
            'Computer Science',
            'Art',
            'Music',
            'Physical Education',
            'Social Studies',
        ];

        // Loop through each name and create a Subject
        foreach ($subjectNames as $name) {
            Subject::create([
                'name' => $name,
            ]);
        }
    }
}
