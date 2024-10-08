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
use Illuminate\Support\Facades\Storage;

class ExamTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view('teacher.exams.index', compact('exams', 'draftExams', 'publishedExams'));
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
            $question->question_number = $i; // Assign question number
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
        return view('teacher.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exam = Exam::with('classrooms')->findOrFail($id);
        $examTypes = ExamType::all();
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        return view('teacher.exams.edit', compact('exam', 'examTypes', 'subjects', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     */
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
        return redirect()->route('teacher.exams.show', ['exam' => $exam->id])->with('success', 'Exam updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Exam $exam)
    {
        // Load the related questions
        $exam->load('questions');
        $exam->load('questions');

        // Iterate over each question and delete associated images
        foreach ($exam->questions as $question) {
            if ($question->image_path) {
                Storage::disk('public')->delete($question->image_path);
            }
        }

        // Delete the directory where question images are stored
        $directoryPath = 'examImages/' . $exam->title;
        Storage::disk('public')->deleteDirectory($directoryPath);

        // Delete the exam and associated questions
        $exam->delete();

        return redirect()->route('teacher.history.index')->with('success', 'Exam deleted successfully.');
    }

    // public function questionsIndex(Exam $exam)
    // {
    //     $questions = $exam->questions;

    //     return view('teacher.exams.questions.index', compact('exam', 'questions'));
    // }

    public function questionsCreate(Exam $exam)
    {
        $exam->load('questions.choices');
        $questions = $exam->questions;

        return view('teacher.exams.questions.create', compact('exam', 'questions'));
    }

    public function questionsStore(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'questions.*.text' => 'required|string',
            'questions.*.correct_choice' => 'required|exists:choices,id',
            'questions.*.choices.*.text' => 'required|string',
            'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ($validatedData['questions'] as $questionId => $questionData) {
            $question = Question::find($questionId);
            $question->question_text = $questionData['text'];

            if (isset($questionData['image'])) {
                // Delete the previous image if it exists
                if ($question->image_path) {
                    Storage::disk('public')->delete($question->image_path);
                }

                // Store the new image
                $image = $questionData['image'];
                $folderPath = 'examImages/' . $exam->title . '/' . $questionId;
                $imagePath = $image->storeAs($folderPath, $questionId . '.' . $image->extension(), 'public');
                $question->image_path = $imagePath;
            }

            $question->save();

            if (isset($questionData['choices'])) {
                foreach ($questionData['choices'] as $choiceId => $choiceData) {
                    $choice = Choice::find($choiceId);
                    $choice->choice_text = $choiceData['text'];
                    $choice->is_correct = ($choiceId == $questionData['correct_choice']);
                    $choice->save();
                }
            }
        }

        $exam->status = 'draft';
        $exam->save();

        return redirect()->route('teacher.exams.show', $exam->id)->with('success', 'Questions saved successfully.');
    }

    public function publish($id)
    {
        $exam = Exam::findOrFail($id);

        if ($exam->status == 'draft') {
            $exam->status = 'published';
            $exam->save();

            return redirect()->route('teacher.exams.show', $id)->with('success', 'Exam published successfully.');
        }

        return redirect()->route('teacher.exams.show', $id)->with('error', 'Exam is not in draft status.');
    }

    /**
     * Complete the exam.
     */
    public function complete($id)
    {
        $exam = Exam::findOrFail($id);

        if ($exam->status == 'published') {
            $exam->status = 'completed';
            $exam->save();

            return redirect()->route('teacher.exams.show', $id)->with('success', 'Exam completed successfully.');
        }

        return redirect()->route('teacher.exams.show', $id)->with('error', 'Exam is not in published status.');
    }

}
