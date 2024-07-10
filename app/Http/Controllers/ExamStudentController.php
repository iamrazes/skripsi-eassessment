<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DataStudent;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Answer;
use App\Models\ExamStudentAnswer;
use App\Models\ExamStudentReport;
use Carbon\Carbon;

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

        // Fetch the logged-in user's data
        $user = Auth::user();
        $dataStudent = DataStudent::where('user_id', $user->id)->first();

        // Fetch the question by exam ID and question number
        $question = Question::where('exam_id', $examId)
                            ->where('question_number', $questionNumber)
                            ->firstOrFail();

        // Determine $currentQuestionIndex based on the question number or any other criteria
        $currentQuestionIndex = $questionNumber - 1; // Adjust if necessary based on your indexing logic

        // Fetch or initialize the student's answer for this question
        $studentAnswer = ExamStudentAnswer::where([
            'exam_id' => $examId,
            'student_id' => auth()->id(),
            'question_id' => $question->id
        ])->first();

        // Initialize an empty array for selected choices
        $selectedChoices = [];

        // If student has answered, explode the selected_choices string into an array
        if ($studentAnswer && $studentAnswer->selected_choices) {
            $selectedChoices = explode(',', $studentAnswer->selected_choices);
        }

        // Pass the exam, question, current question index, student data, and selected choices to the view
        return view('student.exams.questions.show', compact('exam', 'question', 'currentQuestionIndex', 'dataStudent', 'selectedChoices'));
    }

    public function saveAnswer(Request $request, $examId, $questionNumber)
    {
        // Fetch the question by exam ID and question number
        $question = Question::where('exam_id', $examId)
                            ->where('question_number', $questionNumber)
                            ->firstOrFail();

        // Validate the request data
        $validatedData = $request->validate([
            'selected_choices' => 'required|array',
        ]);

        // Convert array of choices to comma-separated string
        $selectedChoices = implode(',', $validatedData['selected_choices']);

        // Update or create the student's answer for this question
        $answer = ExamStudentAnswer::updateOrCreate(
            [
                'exam_id' => $examId,
                'student_id' => auth()->id(),
                'question_id' => $question->id
            ],
            [
                'selected_choices' => $selectedChoices
            ]
        );

        // Redirect back with a success message
        return back()->with('success', 'Answer saved successfully.');
    }

    public function finishExam($examId)
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Fetch the exam by ID
        $exam = Exam::findOrFail($examId);

        // Check if all questions have been answered
        $questions = $exam->questions;
        $answeredQuestions = ExamStudentAnswer::where('exam_id', $examId)
                                               ->where('student_id', $user->id)
                                               ->pluck('question_id')
                                               ->toArray();

        if (count($questions) !== count($answeredQuestions)) {
            return back()->with('error', 'You must answer all questions before finishing the exam.');
        }

        // Calculate the score and prepare answers
        $correctAnswers = 0;
        $studentAnswers = [];
        $correctAnswersData = [];

        foreach ($questions as $question) {
            $studentAnswer = ExamStudentAnswer::where('exam_id', $examId)
                                              ->where('student_id', $user->id)
                                              ->where('question_id', $question->id)
                                              ->first();

            if ($studentAnswer) {
                $correctChoices = $question->choices()->where('is_correct', true)->pluck('id')->toArray();
                $selectedChoices = json_decode($studentAnswer->selected_choices, true);

                $studentAnswers[$question->id] = $selectedChoices;
                $correctAnswersData[$question->id] = $correctChoices;

                if (is_array($selectedChoices) && array_diff($correctChoices, $selectedChoices) === array_diff($selectedChoices, $correctChoices)) {
                    $correctAnswers++;
                }
            }
        }

        $score = ($correctAnswers / count($questions)) * 100;

        // Store the report
        ExamStudentReport::updateOrCreate(
            [
                'exam_id' => $examId,
                'student_id' => $user->id
            ],
            [
                'student_answers' => json_encode($studentAnswers),
                'correct_answers' => json_encode($correctAnswersData),
                'score' => $score
            ]
        );

        return redirect()->route('students.reports.index')->with('success', 'Exam finished successfully.');
    }

}
