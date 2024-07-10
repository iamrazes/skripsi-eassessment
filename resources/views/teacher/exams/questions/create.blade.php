{{-- @extends('layouts.app')

@section('title')
    <title>Manage Questions - {{ $exam->title }}</title>
@endsection

@section('content')
    @if ($errors->any())
        <div class="mt-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-8 bg-white rounded-lg shadow-button py-6">
        <div class="flex justify-between mb-4 px-8">
            <h1 class="font-semibold text-xl">Manage Questions</h1>
            <div class="flex gap-x-2">
                <button id="toggleSinglePageView"
                    class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Single Page
                    View</button>
                <button id="toggleOneQuestionView"
                    class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Single Question View</button>
            </div>
        </div>

        <div id="singlePageView" class="view-mode">
            <form id="questionnaireForm" action="{{ route('teacher.exams.questions.store', $exam->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @foreach ($exam->questions as $index => $question)
                    <div class="flex pb-6 border-b mx-8 mb-6">
                        <div class="mr-8 text-xl">{{ $index + 1 }}.</div>
                        <div class="flex flex-col flex-grow">
                            <span class="text-xs text-gray-400 mb-2">Fill the questions in the box below</span>
                            <textarea name="questions[{{ $question->id }}][text]" class="w-full rounded-lg border-1 border-gray-400 mb-4" rows="8">{{ old('questions.' . $question->id . '.text', $question->question_text) }}</textarea>
                            @if ($question->image_path)
                                <img src="{{ Storage::url($question->image_path) }}" alt="Question Image" class="mb-4 image-preview">
                            @endif
                            <input type="file" name="questions[{{ $question->id }}][image]" class="mb-4">
                            <div class="mt-0">
                                <div class="flex flex-col">
                                    <span class="text-xs mb-2 text-gray-400">Select the correct answer & Fill the answer option</span>
                                    <div class="flex flex-col gap-y-2">
                                        @foreach ($question->choices as $choice)
                                            <div class="flex items-center">
                                                <input type="radio" name="questions[{{ $question->id }}][correct_choice]" value="{{ $choice->id }}" class="h-8 w-16 rounded-lg border-gray-400" {{ old('questions.' . $question->id . '.correct_choice', $choice->is_correct ? $choice->id : '') == $choice->id ? 'checked' : '' }}>
                                                <input type="text" name="questions[{{ $question->id }}][choices][{{ $choice->id }}][text]" value="{{ old('questions.' . $question->id . '.choices.' . $choice->id . '.text', $choice->choice_text) }}" class="h-8 rounded-lg border-gray-400 ml-2 w-full">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end gap-x-2 mt-4">
                                <button type="button" class="clear-btn bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2" data-question-id="{{ $question->id }}">Clear</button>
                                <button type="button" class="save-progress-btn bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2" data-question-id="{{ $question->id }}">Save Progress</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex mx-8 mt-4">
                    <button id="submitButton" type="submit" class="bg-accent-1 transition hover:bg-accent-2 w-full font-medium text-white rounded-lg px-6 py-3">Submit All</button>
                </div>
            </form>
        </div>

        <div id="oneQuestionView" class="view-mode hidden">
            <form id="singleQuestionForm" action="{{ route('teacher.exams.questions.store', $exam->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="questionContainer"></div>
                <div class="flex justify-between mt-4 mx-8">
                    <button type="button" id="prevQuestion" class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Previous</button>
                    <button type="button" id="nextQuestion" class="bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2">Next</button>
                </div>
                <div class="flex mx-8 mt-4">
                    <button id="submitSingleQuestion" type="submit" class="bg-accent-1 transition hover:bg-accent-2 w-full font-medium text-white rounded-lg px-6 py-3">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Confirmation</h2>
            <p>Are you sure you want to submit the questionnaire? Please ensure all questions and answers are filled.</p>
            <div class="mt-4 flex justify-end">
                <button id="confirmYes" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Yes</button>
                <button id="confirmNo" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">No</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Switch between views
        document.getElementById('toggleSinglePageView').addEventListener('click', function() {
            document.getElementById('singlePageView').classList.remove('hidden');
            document.getElementById('oneQuestionView').classList.add('hidden');
        });

        document.getElementById('toggleOneQuestionView').addEventListener('click', function() {
            document.getElementById('singlePageView').classList.add('hidden');
            document.getElementById('oneQuestionView').classList.remove('hidden');
            showQuestion(0);
        });

        let currentQuestionIndex = 0;
        const questions = @json($exam->questions);

        function showQuestion(index) {
            const question = questions[index];
            const questionContainer = document.getElementById('questionContainer');
            questionContainer.innerHTML = `
                <div class="flex pb-6 border-b mx-8 mb-6">
                    <div class="mr-8 text-xl">${index + 1}.</div>
                    <div class="flex flex-col flex-grow">
                        <span class="text-xs text-gray-400 mb-2">Fill the questions in the box below</span>
                        <textarea name="questions[${question.id}][text]" class="w-full rounded-lg border-1 border-gray-400 mb-4" rows="8">${question.question_text}</textarea>
                        ${question.image_path ? `<img src="${question.image_path}" alt="Question Image" class="mb-4 image-preview">` : ''}
                        <input type="file" name="questions[${question.id}][image]" class="mb-4">
                        <div class="mt-0">
                            <div class="flex flex-col">
                                <span class="text-xs mb-2 text-gray-400">Select the correct answer & Fill the answer option</span>
                                <div class="flex flex-col gap-y-2">
                                    ${question.choices.map(choice => `
                                        <div class="flex items-center">
                                            <input type="radio" name="questions[${question.id}][correct_choice]" value="${choice.id}" class="h-8 w-16 rounded-lg border-gray-400" ${choice.is_correct ? 'checked' : ''}>
                                            <input type="text" name="questions[${question.id}][choices][${choice.id}][text]" value="${choice.choice_text}" class="h-8 rounded-lg border-gray-400 ml-2 w-full">
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end gap-x-2 mt-4">
                            <button type="button" class="clear-btn bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2" data-question-id="${question.id}">Clear</button>
                            <button type="button" class="save-progress-btn bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2" data-question-id="${question.id}">Save Progress</button>
                        </div>
                    </div>
                </div>
            `;
        }

        document.getElementById('nextQuestion').addEventListener('click', function() {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            }
        });

        document.getElementById('prevQuestion').addEventListener('click', function() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                showQuestion(currentQuestionIndex);
            }
        });

        // Confirmation Modal
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('confirmationModal').classList.remove('hidden');
        });

        document.getElementById('confirmYes').addEventListener('click', function() {
            document.getElementById('questionnaireForm').submit();
        });

        document.getElementById('confirmNo').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        document.getElementById('submitSingleQuestion').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('confirmationModal').classList.remove('hidden');
        });
    </script>
@endsection --}}

@extends('layouts.app')

@section('title')
    <title>Manage Questions - {{ $exam->title }}</title>
@endsection

@section('content')
    @if ($errors->any())
        <div class="mt-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input:</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    @php
                        // Extract the error part after the last dot (.) and before the first space
                        $errorText = preg_replace('/\bchoices\.\d+\b/', 'choices', $error);
                    @endphp
                    <li>{{ ucfirst(str_replace('.', ' ', $errorText)) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-8 bg-white rounded-lg shadow-button py-6">
        <div class="flex flex-col">
            <div class="flex justify-between mb-2 border-b pb-6 px-8">
                <div class="flex flex-col">
                    <h1 class="font-semibold text-xl">Manage Questions</h1>
                    <span class="text-sm">{{ $exam->title }}</span>
                </div>
            </div>

            <div id="singlePageView" class="flex flex-col gap-y-8 pt-4">
                @if ($exam->questions && $exam->questions->isNotEmpty())
                    <form id="questionnaireForm" action="{{ route('teacher.exams.questions.store', $exam->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($exam->questions as $index => $question)
                            <div class="flex pb-6 border-b mx-8 mb-6">
                                <div class="mr-8 text-xl">{{ $index + 1 }}.</div>
                                <div class="flex flex-col flex-grow">
                                    <span class="text-xs text-gray-400 mb-2">Fill the questions in the box below</span>
                                    <textarea name="questions[{{ $question->id }}][text]" class="w-full rounded-lg border-1 border-gray-400 mb-4"
                                        rows="8">{{ old('questions.' . $question->id . '.text', $question->question_text) }}</textarea>

                                    <!-- Image Upload and Preview -->
                                    <div class="flex justify-between items-center">
                                        <input type="file" name="questions[{{ $question->id }}][image]" accept="image/*"
                                            class="mb-4 question-image-upload" data-question-id="{{ $question->id }}">
                                        <div class="image-preview flex justify-end gap-x-4"
                                            data-question-id="{{ $question->id }}">
                                            @if ($question->image_path)
                                                <div class="flex items-center">
                                                    <span
                                                        class="text-xs mr-2 preview-image cursor-pointer hover:text-accent-1"
                                                        data-image-src="{{ Storage::url($question->image_path) }}">Click to
                                                        Preview</span>
                                                    <img src="{{ Storage::url($question->image_path) }}"
                                                        class="h-8 preview-image cursor-pointer" alt="Preview"
                                                        data-image-src="{{ Storage::url($question->image_path) }}">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-0">
                                        <div class="flex flex-col">
                                            <span class="text-xs mb-2 text-gray-400">Select the correct answer & Fill the answer option</span>
                                            <div class="flex flex-col gap-y-2">
                                                @if ($question->choices && $question->choices->isNotEmpty())
                                                    @foreach ($question->choices as $index => $choice)
                                                        <div class="flex items-center">
                                                            <span class="mr-3 lowercase">{{ chr(65 + $index) }}.</span>
                                                            <input type="radio"
                                                                name="questions[{{ $question->id }}][correct_choice]"
                                                                value="{{ $choice->id }}"
                                                                class="h-8 w-16 rounded-lg border-gray-400"
                                                                {{ old('questions.' . $question->id . '.correct_choice', $choice->is_correct ? $choice->id : '') == $choice->id ? 'checked' : '' }}>
                                                            <input type="text"
                                                                name="questions[{{ $question->id }}][choices][{{ $choice->id }}][text]"
                                                                value="{{ old('questions.' . $question->id . '.choices.' . $choice->id . '.text', $choice->choice_text) }}"
                                                                class="h-8 rounded-lg border-gray-400 ml-2 w-full">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No choices available for this question.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-x-2 mt-4">
                                        <button type="button"
                                            class="clear-btn bg-gray-100 rounded-lg border border-gray-400 hover:bg-gray-200 px-4 py-2"
                                            data-question-id="{{ $question->id }}">Clear</button>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex mx-8 mt-4">
                            <button id="submitButton" type="submit"
                                class="bg-accent-1 transition hover:bg-accent-2 w-full font-medium text-white rounded-lg px-6 py-3">Submit
                                All</button>
                        </div>
                    </form>
                @else
                    <p class="mx-8">No questions available.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-4 rounded-lg my-12 flex flex-col">
            <div class="close-preview text-red-500 cursor-pointer text-end mb-2 flex items-center justify-end">Close <img
                    src="{{ asset('icons/ic_incorrect.svg') }}" alt=""></div>
            <img id="modalImagePreview" src="" alt="Image Preview" class="max-h-[512px]">
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Confirmation</h2>
            <p>Are you sure you want to submit the questionnaire? Please ensure all questions and answers are filled.</p>
            <div class="mt-4 flex justify-end">
                <button id="confirmYes"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Yes</button>
                <button id="confirmNo"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">No</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Clear button functionality
        document.querySelectorAll('.clear-btn').forEach(button => {
            button.addEventListener('click', function() {
                const questionDiv = this.closest('.flex.pb-6.border-b');
                const textareas = questionDiv.querySelectorAll('textarea');
                const textInputs = questionDiv.querySelectorAll('input[type="text"]');
                const radioButtons = questionDiv.querySelectorAll('input[type="radio"]');

                textareas.forEach(textarea => textarea.value = '');
                textInputs.forEach(input => input.value = '');
                radioButtons.forEach(radio => radio.checked = false);

                const previewImage = questionDiv.querySelector('.image-preview');
                if (previewImage) {
                    previewImage.src = '';
                    previewImage.classList.add('hidden');
                }
            });
        });

        // Image preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('imagePreviewModal');
            const modalImage = document.getElementById('modalImagePreview');
            const closePreview = document.querySelector('.close-preview');

            document.querySelectorAll('.preview-image').forEach(img => {
                img.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image-src');
                    modalImage.src = imageUrl;
                    modal.classList.remove('hidden');
                });
            });

            closePreview.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        // Submit confirmation modal functionality
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault();
            const isFormValid = validateForm();
            if (isFormValid) {
                document.getElementById('confirmationModal').classList.remove('hidden');
            } else {
                alert('Please fill all questions and answer choices before submitting.');
            }
        });

        document.getElementById('confirmYes').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
            document.getElementById('questionnaireForm').submit();
        });

        document.getElementById('confirmNo').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        function validateForm() {
            let isValid = true;
            document.querySelectorAll('.question').forEach(question => {
                const answer = question.querySelector('input[name="answer"]:checked');
                if (!answer) {
                    isValid = false;
                }
            });
            return isValid;
        }
    </script>
@endsection
