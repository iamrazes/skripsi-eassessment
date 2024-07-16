<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamStudentAnswer;
use App\Models\ExamStudentReport;
use App\Models\User;
use App\Models\DataStudent;

class ExamStudentReportController extends Controller
{

    public function index()
    {
        $studentId = Auth::id(); // Get the authenticated student's ID
        $attendedExams = ExamStudentReport::where('student_id', $studentId)
                                          ->with('exam')
                                          ->get();

        return view('student.reports.index', compact('attendedExams'));
    }

    public function show(Exam $exam)
    {
        $studentId = Auth::id(); // Get the authenticated student's ID

        $studentReport = ExamStudentReport::where('exam_id', $exam->id)
                                          ->where('student_id', $studentId)
                                          ->firstOrFail();

        $studentAnswers = ExamStudentAnswer::where('exam_id', $exam->id)
                                           ->where('student_id', $studentId)
                                           ->get();

        $studentAnswers->each(function ($answer) {
            $answer->selected_choices = explode(',', $answer->selected_choices);
        });

        return view('student.reports.show', compact('exam', 'studentReport', 'studentAnswers'));
    }
}
