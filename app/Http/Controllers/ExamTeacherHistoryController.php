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
        return view('teacher.history.show', compact('exam'));

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

}
