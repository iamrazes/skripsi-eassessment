@extends('layouts.dashboard')

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
        <div class="flex flex-col">
            <div class="flex justify-between mb-2 border-b pb-6 px-8">
                <div class="flex flex-col">
                    <h1 class="font-semibold text-xl">Manage Questions</h1>
                    <span class="text-sm">{{ $exam->title }}</span>
                </div>
            </div>

            <div id="singlePageView" class="flex flex-col gap-y-8 pt-4">
                @if ($exam->questions && $exam->questions->isNotEmpty())
                    <form id="questionnaireForm" action="{{ route('teacher.exams.questions.store', $exam->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($exam->questions as $index => $question)
                            <div class="flex pb-6 border-b mx-8 mb-6">
                                <div class="mr-8 text-xl">{{ $index + 1 }}.</div>
                                <div class="flex flex-col flex-grow">
                                    <span class="text-xs text-gray-400 mb-2">Fill the questions in the box below</span>
                                    <textarea name="questions[{{ $question->id }}][text]" class="w-full rounded-lg border-1 border-gray-400 mb-4" rows="8">{{ $question->question_text }}</textarea>

                                    <!-- Image Upload and Preview -->
                                    <div class="flex justify-between">
                                        <input type="file" name="questions[{{ $question->id }}][image]" accept="image/*" class="mb-4 question-image-upload" data-question-id="{{ $question->id }}">
                                        <div class="image-preview flex justify-end gap-x-4" data-question-id="{{ $question->id }}">
                                            <span class="text-xs text-blue-500 cursor-pointer hidden preview-text mt-2">Click to Preview</span>
                                            <img src="" class="h-8 hidden" alt="Preview">
                                        </div>
                                    </div>

                                    <div class="mt-0">
                                        <div class="flex flex-col">
                                            <span class="text-xs mb-2 text-gray-400">Select the correct answer & Fill the answer option</span>
                                            <div class="flex flex-col gap-y-2">
                                                @if ($question->choices && $question->choices->isNotEmpty())
                                                    @foreach ($question->choices as $choice)
                                                        <div class="flex items-center">
                                                            <input type="radio" name="questions[{{ $question->id }}][correct_choice]" value="{{ $choice->id }}" class="h-8 w-16 rounded-lg border-gray-400" {{ $choice->is_correct ? 'checked' : '' }}>
                                                            <input type="text" name="questions[{{ $question->id }}][choices][{{ $choice->id }}][text]" value="{{ $choice->choice_text }}" class="h-8 rounded-lg border-gray-400 ml-2 w-full">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No choices available for this question.</p>
                                                @endif
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
                @else
                    <p class="mx-8">No questions available.</p>
                @endif
            </div>
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

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-4 rounded-lg my-12 flex flex-col">
            <span class="close-preview text-red-500 cursor-pointer text-end">Close</span>
            <img id="modalImagePreview" src="" alt="Image Preview" class="max-h-[512px]">
        </div>
    </div>
@endsection

@section('script')
<script>
document.querySelectorAll('.clear-btn').forEach(button => {
    button.addEventListener('click', function () {
        const questionDiv = this.closest('.flex.pb-6.border-b');
        const textareas = questionDiv.querySelectorAll('textarea');
        const textInputs = questionDiv.querySelectorAll('input[type="text"]');
        const radioButtons = questionDiv.querySelectorAll('input[type="radio"]');

        textareas.forEach(textarea => textarea.value = '');
        textInputs.forEach(input => input.value = '');
        radioButtons.forEach(radio => radio.checked = false);
    });
});

document.addEventListener('click', function (event) {
    const modal = document.getElementById('imagePreviewModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

document.querySelectorAll('.popOutZoom').forEach(image => {
    image.addEventListener('click', function () {
        const modal = document.getElementById('imagePreviewModal');
        const modalImg = document.getElementById('modalImagePreview');
        modal.style.display = 'block';
        modalImg.src = this.nextElementSibling.src;
    });
});

document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('imagePreviewModal').style.display = 'none';
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitButton = document.getElementById('submitButton');
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmYes = document.getElementById('confirmYes');
        const confirmNo = document.getElementById('confirmNo');

        submitButton.addEventListener('click', function(event) {
            event.preventDefault();

            // Validate that all questions and answer choices are filled
            const isFormValid = validateForm();
            if (isFormValid) {
                confirmationModal.classList.remove('hidden');
            } else {
                alert('Please fill all questions and answer choices before submitting.');
            }
        });

        confirmYes.addEventListener('click', function() {
            confirmationModal.classList.add('hidden');
            document.getElementById('questionnaireForm').submit();
        });

        confirmNo.addEventListener('click', function() {
            confirmationModal.classList.add('hidden');
        });

        function validateForm() {
            // Implement your validation logic here
            // Ensure all questions and answer choices are filled
            // Return true if the form is valid, otherwise return false

            // Example:
            let isValid = true;
            const questions = document.querySelectorAll('.question');
            questions.forEach(question => {
                const answer = question.querySelector('input[name="answer"]:checked');
                if (!answer) {
                    isValid = false;
                }
            });
            return isValid;
        }
    });
</script>
@endsection
