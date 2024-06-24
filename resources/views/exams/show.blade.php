@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Exam Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $exam->title }}</h5>
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
                <a href="{{ route('teacher.exams.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
