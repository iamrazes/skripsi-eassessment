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
                        <div class="flex gap-x-4">
                            <div class=" flex border-r-2 text-xs lg:text-base pr-4 gap-x-2 lg:gap-x-6">
                                <div class="flex flex-col">
                                    <span>Day: {{ $attendedExam->exam->date->format('l') }}</span>
                                    <span>Date: {{ $attendedExam->exam->date->format('d-m-Y') }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span>Hour: {{ \Carbon\Carbon::parse($attendedExam->exam->start_time)->format('H:i') }}</span>
                                    <span>Duration: {{ $attendedExam->exam->duration }} minutes</span>
                                    <span>Question: {{ $attendedExam->exam->total_questions }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col text-center border-r-2 pr-4">
                                <span class="text-sm lg:text-base">Score</span>
                                <span class="text-2xl lg:text-4xl font-semibold">{{ $attendedExam->score }}</span>
                            </div>
                            <div class="flex flex-col gap-y-2 text-xs lg:text-base text-start">
                                <a href="" class="bg-accent-1 rounded text-white px-2 py-1 flex gap-x-1.5 whitespace-nowrap overflow-clip hover:bg-gradient-to-r from-accent-1 to-accent-2 pr-10"><img src="{{asset('icons/ic_magnifier.svg')}}" class="w-4 lg:w-5 filter-white">Review Exam</a>
                                <a href="" class="bg-red-500 rounded text-white px-2 py-1 flex gap-x-1.5 whitespace-nowrap overflow-clip hover:bg-red-400"><img src="{{asset('icons/ic_alert.svg')}}" class="w-4 lg:w-5 filter-white">Report a Problem</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
