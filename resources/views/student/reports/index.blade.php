@extends('layouts.app')

@section('title')
    <title>Student Reports - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mx-4 lg:mx-0 mt-8">
        @if ($attendedExams->isEmpty())
            <p class="text-gray-600 text-4xl text-center lg:py-80">You haven't attended any exams yet.</p>
        @else
            <div class="flex flex-col gap-y-4">
                @foreach ($attendedExams as $attendedExam)
                    <div class="bg-white rounded-lg shadow-button items-center flex justify-between p-4">
                        <div>
                            <img src="{{ asset('icons/ic_assessment-published2.svg') }}" class="lg:w-16">
                        </div>
                        <div class="flex-grow">
                            <div class="flex flex-col mx-4">
                                <span class="font-semibold lg:text-2xl">{{ $attendedExam->exam->examType->name }}</span>
                                <span class="text-lg">{{ $attendedExam->exam->subject->name }}</span>
                            </div>
                        </div>
                        <div class="flex gap-x-4 ">
                            <div class=" flex text-xs lg:text-base pr-4 gap-x-2 lg:gap-x-6">
                                <div class="flex flex-col">
                                    <span>Day: {{ $attendedExam->exam->date->format('l') }}</span>
                                    <span>Date: {{ $attendedExam->exam->date->format('d-m-Y') }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span>Hour:
                                        {{ \Carbon\Carbon::parse($attendedExam->exam->start_time)->format('H:i') }}</span>
                                    <span class="flex gap-x-1">Duration: <span class="min-w-10">{{ $attendedExam->exam->duration }}</span></span>
                                    <span>Question: {{ $attendedExam->exam->total_questions }}</span>
                                </div>
                            </div>
                            <!-- options -->
                            <div class="flex flex-col gap-y-2 text-xs lg:text-base text-start flex-grow">
                                <a href="{{ route('students.reports.show', ['exam' => $attendedExam->exam->id]) }}"
                                    class="bg-accent-1 rounded text-white px-2 py-1 flex gap-x-1.5 whitespace-nowrap overflow-clip hover:bg-gradient-to-r from-accent-1 to-accent-2 pr-10"><img
                                        src="{{ asset('icons/ic_magnifier.svg') }}" class="w-4 lg:w-5 filter-white">Review
                                    Exam</a>
                                <button data-score="{{ $attendedExam->score }}"
                                    class="scoreButton bg-gray-500 rounded text-white px-2 py-1 flex gap-x-1.5 whitespace-nowrap overflow-clip items-center hover:bg-gradient-to-r from-gray-500 to-gray-400"><img
                                        src="{{ asset('icons/ic_alert.svg') }}" class="w-4 lg:w-5 filter-white">Check
                                    Score</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="scoreModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-3xl font-semibold mb-4 text-center">Your Score</h2>
            <div class="p-40">
                <p id="scoreDisplay" class="text-6xl text-center font-bold w-20"></p>
            </div>
            <div class="mt-4 flex justify-end">
                <button id="closeButton"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Close</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const scoreButtons = document.querySelectorAll('.scoreButton');
            const scoreModal = document.getElementById('scoreModal');
            const scoreDisplay = document.getElementById('scoreDisplay');
            const closeButton = document.getElementById('closeButton');

            scoreButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const score = button.getAttribute('data-score');
                    scoreDisplay.textContent = score;
                    scoreModal.classList.remove('hidden');
                });
            });

            closeButton.addEventListener('click', function () {
                scoreModal.classList.add('hidden');
            });

            window.addEventListener('click', function (event) {
                if (event.target === scoreModal) {
                    scoreModal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
