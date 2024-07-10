<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamTeacherHistoryController extends Controller
{

    public function index()
    {
        $teacherId = auth()->id(); // Get the authenticated teacher's ID

        $exams = Exam::with('examType', 'subject', 'teacher')
                    ->where('teacher_id', $teacherId)
                    ->orderBy('created_at', 'desc') // Sort by creation date, descending
                    ->get();

        $draftExams = Exam::where('status', 'draft')
                    ->where('teacher_id', $teacherId)
                    ->get();

        $publishedExams = Exam::where('status', 'published')
                    ->where('teacher_id', $teacherId)
                    ->get();

        return view('teacher.history.index', compact('exams', 'draftExams', 'publishedExams'));
    }
}
