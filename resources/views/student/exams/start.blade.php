@extends('layouts.test')

@section('content')
    <!-- Exam questions -->
    @foreach ($exam->questions as $index => $question)
        <div class="flex flex-col gap-y-4 bg-white shadow-button rounded-lg p-3 lg:p-6">
            <div class="flex items-center gap-x-4">
                <div class="flex items-center justify-center rounded-full border border-accent-2 h-10 w-10">
                    <span class="font-semibold">{{ $index + 1 }}</span>
                </div>
                <span>Multiple Choices</span>
            </div>
            <div class="flex flex-col bg-slate-100 min-h-96 rounded-lg p-4 items-center overflow-hidden">
                <p class="whitespace-pre-line w-full lg:text-lg">{{ $question->question_text }}</p>
                @if ($question->image_path)
                    <img src="{{ Storage::url($question->image_path) }}" class="max-h-72 max-w-fit my-4" alt="">
                @endif
            </div>
            {{-- Exam choices --}}
            <span class="text-gray-400 text-sm">Select your answer on the options below:</span>
            <div class="flex flex-col gap-4 pb-4">
                @foreach ($question->choices as $choiceIndex => $choice)
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" name="answers[{{ $question->id }}]" value="{{ $choice->id }}">
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">{{ chr(97 + $choiceIndex) }}.</span>
                            <span class="ml-3">{{ $choice->choice_text }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <!-- Navigation buttons -->
    <div class="flex flex-col gap-y-4 lg:gap-y-8 mx-4 lg:mx-0">
        <div class="grid grid-cols-3 justify-between shadow-button">
            {{-- clear selection --}}
            <button class="bg-white hover:bg-gray-100 rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Clear</button>
            {{-- mark the number = giving different color on navigation sidebar  --}}
            <button class="bg-white hover:bg-gray-100 border-x-2 lg:px-6 lg:py-4 py-2 px-2 flex-grow">Mark</button>
            {{-- save answer, still in the same page --}}
            <button class="bg-white hover:bg-gray-100 rounded-r-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Save</button>
        </div>
        <div class="flex justify-start shadow-button">
            {{-- go back if theres any --}}
            <a
                class="bg-white hover:bg-gray-100 text-center rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow"><img
                    src="{{ asset('icons/ic_left.svg') }}" alt="">Previous</a>
            {{-- go next question --}}
            <a
                class="bg-white hover:bg-gray-100 text-center rounded-r-xl border-l-2 lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">Save
                & Next<img src="{{ asset('icons/ic_right.svg') }}" alt=""></a>
        </div>
        {{-- submit all the answer only appear at the last question or all question answered --}}
        <a
            class="bg-orange-400 text-white font-semibold hover:bg-orange-300 text-center rounded-xl lg:px-6 lg:py-4 py-2 px-2 shadow-button flex justify-center items-center flex-grow">Finish
            & Submit</a>
    </div>
@endsection
