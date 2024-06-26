<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataStudent;
use App\Models\DataTeacher;
use App\Models\DataAdmin;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Subject;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        $dataStudent = DataStudent::where('user_id', $user->id)->first();
        $dataTeacher = DataTeacher::where('user_id', $user->id)->first();
        $dataAdmin = DataAdmin::where('user_id', $user->id)->first();

        $teacherId = auth()->id(); // Get the authenticated teacher's ID
        $exams = Exam::with('examType', 'subject', 'teacher')
                    ->where('teacher_id', $teacherId)
                    ->get();

        return view('profile', compact('user', 'dataStudent', 'dataAdmin', 'dataTeacher', 'exams'));
    }
}
