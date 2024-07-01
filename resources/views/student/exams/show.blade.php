@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>{{ $exam->title }}</h1>
        <p>{{ $exam->description }}</p>
        <p>Subject: {{ $exam->subject->name }}</p>
        <p>Type: {{ $exam->examType->name }}</p>
        <p>Date: {{ $exam->date->format('F j, Y') }}</p>
        <p>Start Time: {{ $exam->start_time }}</p>
        <p>Duration: {{ $exam->duration }} minutes</p>
        <!-- Add more exam details as needed -->
    </div>
@endsection
