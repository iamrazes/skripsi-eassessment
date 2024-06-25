<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with('examType', 'subject', 'teacher')->get();
        $draftExams = Exam::where('status', 'draft')->get();

        return view('teacher.exams.index', compact('exams', 'draftExams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $examTypes = ExamType::all();
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        return view('teacher.exams.create', compact('examTypes', 'subjects', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            "E-Assessment - %s %s - %s - %s",
            $examType->name,
            $subject->name,
            now()->format('Y'),
            Str::random(8)
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

        return redirect()->route('teacher.exams.questions.create', ['exam' => $exam->id])->with('success', 'Exam created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // Code for showing a single exam (not provided in original)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        // Code for editing an exam (not provided in original)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        // Code for updating an exam (not provided in original)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('teacher.exams.index')->with('success', 'Exam deleted successfully.');
    }

    public function questionsIndex(Exam $exam)
    {
        $questions = $exam->questions;

        return view('teacher.exams.questions.index', compact('exam', 'questions'));
    }

    public function questionsCreate(Exam $exam)
    {
        $exam->load('questions.choices'); // Eager-load the questions and their choices
        return view('teacher.exams.questions.create', compact('exam'));
    }

    public function questionsStore(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.choices' => 'required|array|min:1',
            'questions.*.choices.*.text' => 'required|string',
            'questions.*.choices.*.is_correct' => 'required|boolean',
        ]);

        foreach ($validatedData['questions'] as $questionData) {
            $question = new Question();
            $question->exam_id = $exam->id;
            $question->text = $questionData['text'];
            $question->save();

            foreach ($questionData['choices'] as $choiceData) {
                $question->choices()->create([
                    'text' => $choiceData['text'],
                    'is_correct' => $choiceData['is_correct'],
                ]);
            }
        }

        return redirect()->route('teacher.exams.questions.index', $exam->id)->with('success', 'Questions added successfully.');
    }
}
