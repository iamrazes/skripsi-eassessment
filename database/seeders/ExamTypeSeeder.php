<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamType;

class ExamTypeSeeder extends Seeder
{
    public function run()
    {
        // Array of exam type names
        $examTypeNames = [
            'Midterm',
            'Final',
            'Quiz',
            'Assignment',
            'Project',
            'Presentation',
            'Lab Exam',
            'Practical Exam',
            'Oral Exam',
            'Mock Exam',
        ];

        // Loop through each name and create an ExamType
        foreach ($examTypeNames as $name) {
            ExamType::create([
                'name' => $name,
            ]);
        }
    }
}
