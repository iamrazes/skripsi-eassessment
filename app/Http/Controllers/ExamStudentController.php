<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamStudentController extends Controller
{
    //

    public function index() {

        // Get the authenticated user
        $student = auth()->user()->dataStudent;

        // Fetch the classroom the student belongs to
        $classroom = $student->classroom;

        // Get the exams associated with the student's classroom
        // Ensure only 'published' exams are fetched
        $exams = Exam::whereHas('classrooms', function ($query) use ($classroom) {
            $query->where('classroom_id', $classroom->id);
        })->where('status', 'published')->get();

        // Pass the exams to the view
        return view('student.exams.index', compact('exams'));
    }


    public function show($id)
    {
        // Fetch the exam by ID
        $exam = Exam::findOrFail($id);

        // Pass the exam to the view
        return view('student.exams.show', compact('exam'));
    }
}
