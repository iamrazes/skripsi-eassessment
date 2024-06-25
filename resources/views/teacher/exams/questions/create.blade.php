@extends('layouts.dashboard')

@section('title')
    <title>Manage Questions - {{ $exam->title }}</title>
@endsection

@section('content')
    <div class="mt-8 bg-white rounded-lg shadow-button py-6">
        <div class="flex flex-col">
            <div class="flex justify-between mb-2 border-b pb-6 px-8">
                <h1 class="font-semibold text-xl">Manage Questions</h1>
                <div class="flex gap-x-2">
                    <span class="mr-2">{{ $exam->title }}</span>
                    <button id="singlePageBtn"><img src="{{ asset('icons/ic_single_page.svg') }}" alt="single page"></button>
                    <button id="perPageBtn"><img src="{{ asset('icons/ic_per_view.svg') }}" alt="one per page"></button>
                </div>
            </div>

            <div id="singlePageView" class="flex flex-col gap-y-8 pt-4">
                @if($exam->questions && $exam->questions->isNotEmpty())
                    @foreach($exam->questions as $index => $question)
                    <div class="flex pb-6 border-b mx-8">
                        <div class="mr-8 text-xl">{{ $index + 1 }}.</div>
                        <div class="flex flex-col flex-grow">
                            <span class="text-xs text-gray-400 mb-2">Fill the questions in the box below</span>
                            <textarea class="w-full rounded-lg border-1 border-gray-400 mb-4" rows="8">{{ $question->text }}</textarea>
                            <div class="flex justify-between">
                                <input type="file" class="">
                                <div id="imagePreview" class="mb-2 flex items-center gap-x-2">
                                    <span class="popOutZoom text-xs">Click to Preview</span>
                                    <img src="{{ asset('images/images.jpg') }}" class="w-10" alt="">
                                </div>
                            </div>
                            <div class="flex gap-x-4 mt-2">
                                <div class="flex flex-col">
                                    <span class="text-xs mb-2 text-gray-400">Select the correct answer</span>
                                    <div class="flex flex-col gap-y-2">
                                        @if($question->choices && $question->choices->isNotEmpty())
                                            @foreach($question->choices as $choice)
                                            <input type="checkbox" name="correct_answer[]" value="{{ $choice->id }}" class="h-8 rounded-lg w-full border-gray-400" {{ $choice->is_correct ? 'checked' : '' }}>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col gap-y-2 flex-grow mb-4">
                                    <span class="text-xs text-gray-400">Fill the question's answer choices</span>
                                    @if($question->choices && $question->choices->isNotEmpty())
                                        @foreach($question->choices as $choice)
                                        <input type="text" name="choices[]" value="{{ $choice->text }}" class="h-8 rounded-lg border-gray-400">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-end gap-x-2">
                                <button class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Clear</button>
                                <button class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Save Progress</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="mx-8">No questions available.</p>
                @endif
            </div>
            <div id="perPageView" class="flex flex-col hidden">
                <div class="flex justify-center pt-6">
                    <ul class="flex gap-x-4">
                        @if($exam->questions && $exam->questions->isNotEmpty())
                            @foreach($exam->questions as $index => $question)
                            <li class="question-indicator bg-gray-100 w-4 h-4 rounded-full cursor-pointer" data-question-index="{{ $index }}"></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <div class="question-contents flex flex-col gap-y-8 pt-4">
                    @if($exam->questions && $exam->questions->isNotEmpty())
                        @foreach($exam->questions as $index => $question)
                        <div class="question-content hidden" data-question-index="{{ $index }}">
                            <div class="flex pb-6 border-b mx-8">
                                <div class="mr-8 text-xl">{{ $index + 1 }}.</div>
                                <div class="flex flex-col flex-grow">
                                    <span class="text-xs text-gray-400 mb-2">Fill the questions in the box below</span>
                                    <textarea class="w-full rounded-lg border-1 border-gray-400 mb-4" rows="8">{{ $question->text }}</textarea>
                                    <div class="flex justify-between">
                                        <input type="file" class="">
                                        <div id="imagePreview" class="mb-2 flex items-center gap-x-2">
                                            <span class="popOutZoom text-xs">Click to Preview</span>
                                            <img src="{{ asset('images/images.jpg') }}" class="w-10" alt="">
                                        </div>
                                    </div>
                                    <div class="flex gap-x-4 mt-2">
                                        <div class="flex flex-col">
                                            <span class="text-xs mb-2 text-gray-400">Select the correct answer</span>
                                            <div class="flex flex-col gap-y-2">
                                                @if($question->choices && $question->choices->isNotEmpty())
                                                    @foreach($question->choices as $choice)
                                                    <input type="checkbox" name="correct_answer[]" value="{{ $choice->id }}" class="h-8 rounded-lg w-full border-gray-400" {{ $choice->is_correct ? 'checked' : '' }}>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-y-2 flex-grow mb-4">
                                            <span class="text-xs text-gray-400">Fill the question's answer choices</span>
                                            @if($question->choices && $question->choices->isNotEmpty())
                                                @foreach($question->choices as $choice)
                                                <input type="text" name="choices[]" value="{{ $choice->text }}" class="h-8 rounded-lg border-gray-400">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-x-2">
                                        <button class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Clear</button>
                                        <button class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Save Progress</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="mx-8">No questions available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var singlePageBtn = document.getElementById('singlePageBtn');
            var perPageBtn = document.getElementById('perPageBtn');
            var singlePageView = document.getElementById('singlePageView');
            var perPageView = document.getElementById('perPageView');
            var questionIndicators = document.querySelectorAll('.question-indicator');
            var questionContents = document.querySelectorAll('.question-content');

            singlePageBtn.addEventListener('click', function () {
                singlePageView.classList.remove('hidden');
                perPageView.classList.add('hidden');
            });

            perPageBtn.addEventListener('click', function () {
                singlePageView.classList.add('hidden');
                perPageView.classList.remove('hidden');
            });

            questionIndicators.forEach(function (indicator, index) {
                indicator.addEventListener('click', function () {
                    questionContents.forEach(function (content) {
                        if (content.getAttribute('data-question-index') === index.toString()) {
                            content.classList.remove('hidden');
                        } else {
                            content.classList.add('hidden');
                        }
                    });
                });
            });
        });
    </script>
@endsection
