<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DataStudent;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Answer;
use Carbon\Carbon;
use App\Models\ExamStudentAnswer;

class ExamStudentController extends Controller
{
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

    public function showQuestion($examId, $questionNumber)
    {
        // Fetch the exam by ID
        $exam = Exam::findOrFail($examId);

        $user = Auth::user();
        $dataStudent = DataStudent::where('user_id', $user->id)->first();

        // Fetch the question by exam ID and question number
        $question = Question::where('exam_id', $examId)
                            ->where('question_number', $questionNumber)
                            ->firstOrFail();

        // Determine $currentQuestionIndex based on the question number or any other criteria
        $currentQuestionIndex = $questionNumber - 1; // Adjust if necessary based on your indexing logic

        // Pass the exam and question to the view
        return view('student.exams.questions.show', compact('exam', 'dataStudent', 'question', 'currentQuestionIndex'));
    }

    public function saveAnswer(Request $request, $examId, $questionNumber)
    {
        $question = Question::where('exam_id', $examId)->where('question_number', $questionNumber)->firstOrFail();

        $validatedData = $request->validate([
            'selected_choices' => 'required|array',
        ]);

        $answer = ExamStudentAnswer::updateOrCreate(
            [
                'exam_id' => $examId,
                'student_id' => auth()->id(),
                'question_id' => $question->id
            ],
            [
                'selected_choices' => json_encode($validatedData['selected_choices'])
            ]
        );

        return back()->with('success', 'Answer saved successfully.');
    }


}
