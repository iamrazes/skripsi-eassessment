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

    // public function show($id)
    // {
    //     $exam = Exam::findOrFail($id);

    //     // Concatenate the date and start time correctly
    //     $examStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $exam->date->format('Y-m-d') . ' ' . $exam->start_time, 'Asia/Jakarta');
    //     $examEndTime = $examStartTime->copy()->addMinutes($exam->duration);

    //     // Get the current time in the same time zone
    //     $currentTime = Carbon::now('Asia/Jakarta');

    //     // Check if the exam is within the available time frame
    //     $isWithinTimeFrame = $currentTime->between($examStartTime, $examEndTime);

    //     // Check if the student has attended the exam
    //     $user = Auth::user();
    //     $hasAttended = ExamStudentAnswer::where('exam_id', $exam->id)
    //                                     ->where('student_id', $user->id)
    //                                     ->exists();

    //     // Determine if the exam is available
    //     $isExamAvailable = !$hasAttended && $isWithinTimeFrame;

    //     return view('student.exams.show', compact('exam', 'isExamAvailable'));
    // }

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

        return view('student.exams.show', compact('exam', 'isExamAvailable'));
    }

    public function showQuestion($examId, $questionNumber)
    {
        // Fetch the exam by ID
        $exam = Exam::findOrFail($examId);

        // Check if exam status is not published or time is over
        if ($exam->status !== 'published' ) {
            return redirect()->route('students.exams.index')->with('error', 'You cannot access this exam.');
        }

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
        return view('student.exams.questions.show', compact('exam', 'question', 'currentQuestionIndex', 'dataStudent', 'selectedChoices'))
               ->with('studentId', $user->id); // Pass the studentId to the view
    }


    public function saveAnswer(Request $request, $examId, $questionNumber)
    {
        // Fetch the question by exam ID and question number
        $question = Question::where('exam_id', $examId)
                            ->where('question_number', $questionNumber)
                            ->firstOrFail();

        $exam = Exam::findOrFail($examId);

        if ($exam->status !== 'published' ) {
            return redirect()->route('students.exams.index')->with('error', 'You cannot access this exam.');
        }

        try {

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

            // Determine the current question index
            $exam = Exam::with('questions')->findOrFail($examId);
            $currentQuestionIndex = $exam->questions->search(function ($q) use ($question) {
                return $q->id == $question->id;
            });

            // Check if the action is "save_next"
            if ($request->input('action') == 'save_next') {
                $nextQuestionIndex = $currentQuestionIndex + 1;
                if ($nextQuestionIndex < count($exam->questions)) {
                    // Redirect to the next question
                    return redirect()->route('students.exams.show-question', [
                        'exam' => $examId,
                        'question' => $exam->questions[$nextQuestionIndex]->question_number
                    ]);
                }
            }

            // Redirect back with a success message
            return back()->with('success', 'Answer saved successfully.');


        } catch (\Exception $e) {
            // Redirect back with an error message
            return back()->with('error', 'An error occurred while saving your answer. Please try again.');
        }
    }


    public static function isQuestionAnswered($examId, $studentId, $questionId)
    {
        return self::where('exam_id', $examId)
            ->where('student_id', $studentId)
            ->where('question_id', $questionId)
            ->exists();
    }

    public function finishExam($examId)
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Fetch the exam by ID
        $exam = Exam::findOrFail($examId);

        // Fetch all questions for the exam
        $questions = $exam->questions;

        // Initialize score variables
        $correctAnswers = 0;
        $totalQuestions = count($questions);
        $studentAnswers = [];
        $correctAnswersData = [];

        foreach ($questions as $question) {
            // Find the corresponding student answer for the question
            $studentAnswer = ExamStudentAnswer::where('exam_id', $examId)
                                              ->where('student_id', $user->id)
                                              ->where('question_id', $question->id)
                                              ->first();

            // Fetch correct choices for the question
            $correctChoices = $question->choices()->where('is_correct', true)->pluck('id')->toArray();

            if ($studentAnswer) {

                // Retrieve selected choices as an array
                $selectedChoices = explode(',', $studentAnswer->selected_choices);

                // Compare selected and correct choices
                if (count($correctChoices) === count($selectedChoices) &&
                    empty(array_diff($correctChoices, $selectedChoices)) &&
                    empty(array_diff($selectedChoices, $correctChoices))) {
                    $correctAnswers++;
                }

                // Store student's selected answers for each question
                $studentAnswers[$question->id] = $selectedChoices;
            } else {
                // If the student didn't answer the question, mark it as unanswered
                $studentAnswers[$question->id] = [];
            }

            // Store correct answers for each question
            $correctAnswersData[$question->id] = $correctChoices;
        }

        // Calculate the score as a percentage
        $score = ($correctAnswers / $totalQuestions) * 100;

        $report = ExamStudentReport::updateOrCreate(
            [
                'exam_id' => $examId,
                'student_id' => $user->id,
            ],
            [
                'student_answers' => $studentAnswers,
                'correct_answers' => $correctAnswersData,
                'score' => $score,
            ]
        );

        return redirect()->route('students.exams.end', ['exam' => $examId])->with('success', 'Exam finished successfully.');
    }


    public function end($id)
    {
        $exam = Exam::findOrFail($id);

        return view('student.exams.end', compact('exam'));
    }

}
