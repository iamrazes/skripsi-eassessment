@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Exam Reports</h1>

        @if ($attendedExams->isEmpty())
            <p class="text-gray-600">You haven't attended any exams yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($attendedExams as $attendedExam)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-lg font-semibold">Exam Title: {{ $attendedExam->exam->title }}</p>
                        <p class="text-gray-600">Date: {{ $attendedExam->exam->date->format('M d, Y') }}</p>
                        <p class="mt-2">Score: {{ $attendedExam->score }}</p>
                        <div class="mt-2">
                            <p class="text-sm font-medium">Details:</p>
                            <ul class="list-disc list-inside">
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
