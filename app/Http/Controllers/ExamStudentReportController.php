<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Answer;
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
}
