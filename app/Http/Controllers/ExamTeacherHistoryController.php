<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\User;
use App\Models\DataStudent;
use App\Models\ExamStudentReport;
use App\Models\ExamStudentAnswer;

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

    public function show(Exam $exam)
    {
        $studentReports = ExamStudentReport::where('exam_id', $exam->id)
        ->with('student', 'student.dataStudent', )
        ->get();

        return view('teacher.history.show', compact('exam', 'studentReports'));

    }

    public function edit($id)
    {
        $exam = Exam::with('classrooms')->findOrFail($id);
        $examTypes = ExamType::all();
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        return view('teacher.history.edit', compact('exam', 'examTypes', 'subjects', 'classrooms'));
    }

    public function update(Request $request, $id)
    {
        // Validate and retrieve data from the request
        $validatedData = $request->validate([
            'exam_type_id' => 'required|exists:exam_types,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration' => 'required|integer|min:1',
            'classrooms' => 'required|array|min:1',
            'description' => 'nullable|string',
        ]);

        // Retrieve the exam model
        $exam = Exam::findOrFail($id);

        // Update the exam details
        $exam->exam_type_id = $validatedData['exam_type_id'];
        $exam->subject_id = $validatedData['subject_id'];
        $exam->date = $validatedData['date'];
        $exam->start_time = $validatedData['start_time'];
        $exam->duration = $validatedData['duration'];
        $exam->description = $validatedData['description'];

        // Save the updated exam
        $exam->save();

        // Sync classrooms with the exam
        $exam->classrooms()->sync($validatedData['classrooms']);

        return redirect()->route('teacher.history.index')->with('success', 'Exam updated successfully.');
    }


    public function answer(Exam $exam, $id)
    {
        // Fetch the student report for the specific student
        $studentReport = ExamStudentReport::where('exam_id', $exam->id)
                                          ->where('student_id', $id)
                                          ->firstOrFail();

        // Fetch the student answers
        $studentAnswers = ExamStudentAnswer::where('exam_id', $exam->id)
                                           ->where('student_id', $id)
                                           ->get();

        // Convert selected_choices from string to array
        $studentAnswers->each(function ($answer) {
            $answer->selected_choices = explode(',', $answer->selected_choices);
        });

        // Load the view with necessary data
        return view('teacher.history.answer', compact('exam', 'studentReport', 'studentAnswers'));
    }

    public function question(Exam $exam)
    {
        // Load questions and their choices
        $exam->load('questions.choices');

        // Fetch correct choices for each question
        foreach ($exam->questions as $question) {
            $question->correct_choice = $question->choices->where('is_correct', true)->first();
        }

        return view('teacher.history.question', compact('exam'));
    }

    public function leaderboards($examId, Request $request)
    {
        // Fetch the exam by ID
        $exam = Exam::findOrFail($examId);

        // Fetch the classroom filter from the request
        $classroomId = $request->input('classroom_id');

        // Fetch all classrooms
        $classrooms = Classroom::all();

        // Fetch the student reports for the exam
        $query = ExamStudentReport::where('exam_id', $examId);

        // Filter by classroom if specified
        if ($classroomId) {
            $query->whereHas('student.datastudent.classroom', function ($q) use ($classroomId) {
                $q->where('id', $classroomId);
            });
        }

        // Get the top 11 student reports, ordered by score descending
        $studentReports = $query->with('student.datastudent.classroom')->orderBy('score', 'desc')->take(11)->get();

        return view('teacher.history.leaderboards', compact('exam', 'studentReports', 'classrooms', 'classroomId'));
    }


}
