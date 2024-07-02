<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Exam;
use Carbon\Carbon;

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
        $exam = Exam::findOrFail($id);

        // Concatenate the date and start time correctly
        $examStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $exam->date->format('Y-m-d') . ' ' . $exam->start_time, 'Asia/Jakarta');
        $examEndTime = $examStartTime->copy()->addMinutes($exam->duration);

        // Get the current time in the same time zone
        $currentTime = Carbon::now('Asia/Jakarta');

        // Determine if the exam is available
        $isExamAvailable = $currentTime->between($examStartTime, $examEndTime);

        // Log the times for debugging
        \Log::info('Exam Start Time: ' . $examStartTime);
        \Log::info('Exam End Time: ' . $examEndTime);
        \Log::info('Current Time: ' . $currentTime);
        \Log::info('Is Exam Available: ' . $isExamAvailable);

        return view('student.exams.show', compact('exam', 'isExamAvailable'));
    }

    public function start($id)
    {
        $exam = Exam::findOrFail($id);

        // Additional logic for starting the exam can go here, if necessary

        return view('student.exams.start', compact('exam'));
    }


}
