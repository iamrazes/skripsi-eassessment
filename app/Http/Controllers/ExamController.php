<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Question;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with('examType', 'subject', 'teacher')->get();
        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $examTypes = ExamType::all();
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        return view('exams.create', compact('examTypes', 'subjects', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Example of creating an exam and generating questions

    // Validate and retrieve data from the request
    $validatedData = $request->validate([
        'exam_type_id' => 'required|exists:exam_types,id',
        'subject_id' => 'required|exists:subjects,id',
        'date' => 'required|date|after_or_equal:today',
        'start_time' => 'required',
        'duration' => 'required|integer|min:1',
        'total_questions' => 'required|integer|min:1|max:100',
        'classrooms' => 'required|array|min:1',
        'description' => 'nullable|string',
    ]);

    // Retrieve the ExamType and Subject models
    $examType = ExamType::findOrFail($validatedData['exam_type_id']);
    $subject = Subject::findOrFail($validatedData['subject_id']);

    // Generate the title
    $title = sprintf(
        "E-Assessment - %s %s - %s - %d",
        $examType->name,
        $subject->name,
        now()->format('Y'),
        Exam::count() + 1
    );

    // Create the exam using Eloquent ORM
    $exam = new Exam();
    $exam->title = $title;
    $exam->exam_type_id = $validatedData['exam_type_id'];
    $exam->subject_id = $validatedData['subject_id'];
    $exam->date = $validatedData['date'];
    $exam->start_time = $validatedData['start_time'];
    $exam->duration = $validatedData['duration'];
    $exam->total_questions = $validatedData['total_questions'];
    $exam->description = $validatedData['description'];
    $exam->teacher_id = auth()->id(); // Assuming authenticated teacher's ID
    $exam->save();

    // Attach classrooms to the exam using sync method
    $exam->classrooms()->sync($validatedData['classrooms']);

    // Generate empty questions for the exam
    for ($i = 1; $i <= $exam->total_questions; $i++) {
        $question = new Question();
        $question->exam_id = $exam->id;
        $question->question_text = ''; // You can leave this empty for the teacher to fill later
        $question->save();
    }

    // Example in ExamController@store method
    return redirect()->route('teacher.exams.questions.index', ['exam' => $exam->id])->with('success', 'Exam created successfully.');
    }

    public function questionsIndex(Exam $exam)
    {
        // Fetch questions related to the exam
        $questions = $exam->questions; // Replace 'questions' with your actual relationship name

        // Return a view with the questions
        return view('exams.questions.index', compact('exam', 'questions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }
}
