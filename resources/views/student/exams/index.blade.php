@extends('layouts.dashboard')

@section('title')
    <title>Assessments - {{ config('app.name') }}</title>
@endsection

@section('content')

    <div class="mt-4 lg:mt-8 mx-4 lg:mx-0 flex flex-col bg-white rounded-lg shadow-button">
        <div class=" py-4 lg:py-6">

            <h1 class="border-b text-lg font-semibold px-4 pb-4 lg:px-8 flex gap-x-2 lg:gap-x-3"> <img
                    src="{{ asset('icons/ic_assessment3.svg') }}" alt="">Available Exams</h1>

            <div class="flex flex-col">
                @if ($exams->isEmpty())
                    {{-- <div class="flex pt-12 pb-8 justify-center">
                    <p>No available exams.</p>
                </div> --}}
                @else
                    <div class="grid lg:grid-cols-3 gap-4 pt-4 lg:pt-6 lg:gap-6 px-4 lg:px-6">

                        @foreach ($exams as $exam)
                            <div class="bg-white p-4 rounded-lg flex flex-col shadow-button">
                                <div class="flex gap-4">
                                    <img src="{{ asset('icons/ic_assessment1.svg') }}" alt="">
                                    <div class="flex flex-col">
                                        <h1 class="font-semibold line-clamp-1 lg:text-lg uppercase">
                                            {{ $exam->examType->name }}</h1>
                                        <h1 class=" line-clamp-2 text-sm lg:text-base">{{ $exam->subject->name }}</h1>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-y-2 mt-2 border-t pt-2">
                                    <div class="mx-2.5 flex flex-col text-sm lg:text-base">
                                        <label class="flex justify-between">Assgined for: <span>
                                                @foreach ($exam->classrooms as $classroom)
                                                    {{ $classroom->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span></label>
                                        <label class="flex justify-between">Total Question:
                                            <span>{{ $exam->total_questions }} Items</span></label>
                                        <label class="flex justify-between">Total Duration:
                                            <span>{{ $exam->total_questions }} Minutes</span></label>
                                        <label class="flex justify-between">Date:
                                            <span class="text-end">{{ $exam->date->format('d/m/Y') }}<br>
                                                (
                                                {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}
                                                )</span></label>
                                    </div>
                                    <a href="{{ route('students.exams.show', $exam->id) }}"
                                        class="bg-accent-1 hover:bg-gradient-to-r from-accent-1 to-accent-2 rounded-3xl text-white font-semibold text-center mt-1 lg:mt-3 py-2 mx-2 lg:mx-2 ">Proceed</a>
                                </div>
                            </div @endforeach>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection
