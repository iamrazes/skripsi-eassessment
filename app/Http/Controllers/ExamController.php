<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Question;
use App\Models\Choice;
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
        $teacherId = auth()->id(); // Get the authenticated teacher's ID

        $exams = Exam::with('examType', 'subject', 'teacher')
                    ->where('teacher_id', $teacherId)
                    ->get();

        $draftExams = Exam::where('status', 'draft')
                         ->where('teacher_id', $teacherId)
                         ->get();

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
        function generateRandomNumericString($length = 8) {
            $randomNumberString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomNumberString .= random_int(0, 9);
            }

            return $randomNumberString;
        }

        // Generate the title
        $title = sprintf(
            "E-Assessment - %s %s - %s - %s",
            $examType->name,
            $subject->name,
            now()->format('Y'),
            generateRandomNumericString(8)
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


        // Generate empty questions and choices for the exam
        for ($i = 1; $i <= $exam->total_questions; $i++) {
            $question = new Question();
            $question->exam_id = $exam->id;
            $question->question_text = ''; // You can leave this empty for the teacher to fill later
            $question->save();

            // Generate 5 blank choices for each question
            for ($j = 1; $j <= 5; $j++) {
                $choice = new Choice();
                $choice->question_id = $question->id;
                $choice->choice_text = ''; // Blank choice text
                $choice->is_correct = false; // Initially, no choice is marked as correct
                $choice->save();
            }
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
        $exam->load('questions.choices');
        return view('teacher.exams.questions.create', compact('exam'));
    }

    public function questionsStore(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'questions.*.text' => 'required|string',
            'choices.*.text' => 'required|string',
            'questions.*.correct_choice' => 'required|exists:choices,id',
        ]);

        foreach ($validatedData['questions'] as $questionId => $questionData) {
            $question = Question::findOrFail($questionId);
            $question->update(['text' => $questionData['text']]);

            if (isset($questionData['image'])) {
                $imagePath = $questionData['image']->store('images', 'public');
                $question->update(['image' => $imagePath]);
            }

            foreach ($question->choices as $choice) {
                $choice->update([
                    'text' => $validatedData['choices'][$choice->id]['text'],
                    'is_correct' => $choice->id == $questionData['correct_choice'],
                ]);
            }
        }

        return redirect()->route('teacher.exams.questions.index', $exam->id)->with('success', 'Questions updated successfully.');
    }
}
