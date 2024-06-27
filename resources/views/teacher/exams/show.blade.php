@extends('layouts.dashboard')

@section('title')
<title>Exam - {{ $exam->title }}</title>
@endsection

@section('content')
    <div class="mt-8 bg-white rounded-lg py-6 px-8 shadow-button">
        <h1>Exam Details</h1>
        <div class="">
            <h5 class="card-title">{{ $exam->title }}</h5>
            <div class="grid grid-cols-2">
                <p class="card-text"><strong>Type:</strong> {{ $exam->examType->name }}</p>
                <p class="card-text"><strong>Subject:</strong> {{ $exam->subject->name }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $exam->date }}</p>
                <p class="card-text"><strong>Start Time:</strong> {{ $exam->start_time }}</p>
                <p class="card-text"><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
                <p class="card-text"><strong>Total Questions:</strong> {{ $exam->total_questions }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $exam->description }}</p>
                <p class="card-text"><strong>Classrooms:</strong>
                    @foreach ($exam->classrooms as $classroom)
                        {{ $classroom->name }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    <div class="flex gap-x-4">
        <a href="{{ route('teacher.exams.index') }}" class="bg-accent-1 hover:bg-accent-2 transition text-white font-medium text-lg rounded-lg px-3 py-2 mt-4">Go Back</a>
        <a href="{{ route('teacher.exams.index') }}" class="bg-accent-1 hover:bg-accent-2 transition text-white font-medium text-lg rounded-lg px-3 py-2 mt-4">Edit Details</a>
        <a href="{{ route('teacher.exams.index') }}" class="bg-accent-1 hover:bg-accent-2 transition text-white font-medium text-lg rounded-lg px-3 py-2 mt-4">Edit Questions</a>
    </div>
@endsection
