@extends('layouts.app')

@section('title')
    <title>Exam - {{ $exam->title }}</title>
@endsection

@section('content')
    <div class="mx-4 lg:mx-0 mt-4 lg:mt-8 bg-white rounded-lg shadow-button">
        <div class="flex flex-col">
            <div class="border-b px-4 py-3">
                <h1 class="flex justify-between">Questionnaire: <span>{{ $exam->title }}</span></h1>
            </div>
            <div class="py-4">
                @foreach ($exam->questions as $index => $question)
                    <div class="flex pb-6 border-b mx-8 mb-6">
                        <div class="w-10 mr-4 text-xl">{{ $index + 1 }}.</div>
                        <div class="flex flex-col w-full">
                            <p class="text-xs">Question:</p>
                            <div class="w-full rounded-lg border-1 bg-white min-h-40 mb-4 mt-2">
                                {{ $question->question_text }}
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <div class="flex justify-between">
                                    <p class="text-xs">Multiple Choices:</p>
                                    <p class="text-xs">Answer Key:</p>
                                </div>
                                <div class="flex flex-col gap-y-1">
                                    @foreach ($question->choices as $choiceIndex => $choice)
                                        <div class="flex items-center">
                                            <span class="w-4 lowercase">{{ chr(65 + $choiceIndex) }}.</span>
                                            <p class="rounded-lg h-max w-full px-2 items-center flex">
                                                {{ $choice->choice_text }}
                                            </p>
                                            <input type="radio" value="{{ $choice->id }}" class="w-8 h-8 flex"
                                                {{ $choice->is_correct ? 'checked' : '' }} disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="text-xs mt-2">Answer:</p>
                            <div class="flex items-center py-2 mt-2 border border-green-600 rounded-xl px-3">
                                <span class="w-4 lowercase">
                                    {{ chr(65 + $question->choices->pluck('id')->search($question->correct_choice->id)) }}.
                                </span>
                                <p class="rounded-lg h-max w-full px-2 items-center flex">
                                    {{ $question->correct_choice->choice_text }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
