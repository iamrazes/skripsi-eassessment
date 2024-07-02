@extends('layouts.app')

@section('title')
    <title>Create an Exam - {{ config('app.name') }}</title>
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
    <div class="mt-8 bg-white rounded-lg shadow-button py-6 px-8">
        <h1 class="font-semibold text-lg">Create Exam</h1>
        <div class=" my-4">
            <form action="{{ route('teacher.exams.store') }}" method="POST">
                @csrf
                <div class="flex flex-col my-3">
                    <label for="exam_type_id">Exam Type</label>
                    <select name="exam_type_id" id="exam_type_id" class="rounded-lg border-gray-400 mt-1">
                        @foreach ($examTypes as $examType)
                            <option value="{{ $examType->id }}"
                                {{ old('exam_type_id') == $examType->id ? 'selected' : '' }}>{{ $examType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col my-3">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id" id="subject_id" class="rounded-lg border-gray-400 mt-1">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col my-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="rounded-lg border-gray-400 mt-1"
                        min="{{ now()->toDateString() }}" value="{{ old('date') }}">
                </div>
                <div class="flex flex-col my-3">
                    <label for="start_time">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="rounded-lg border-gray-400 mt-1"
                        value="{{ old('start_time') }}">
                </div>
                <div class="flex flex-col my-3">
                    <label for="duration">Duration (in minutes)</label>
                    <input type="number" name="duration" id="duration" class="rounded-lg border-gray-400 mt-1"
                        min="1" value="{{ old('duration') }}">
                </div>
                <div class="flex flex-col my-3">
                    <label for="total_questions">Total Questions</label>
                    <input type="number" name="total_questions" id="total_questions"
                        class="rounded-lg border-gray-400 mt-1" min="1" max="100"
                        value="{{ old('total_questions') }}">
                </div>

                <div class="flex flex-col my-3">
                    <label for="classrooms">Classrooms</label>
                    <div id="selectedItems" class="flex flex-wrap gap-2"></div>
                    <div class="relative">
                        <div id="dropdownButton"
                            class="block w-full px-4 py-2 bg-white border border-gray-400 rounded-lg cursor-pointer mt-1">
                            Select classrooms
                        </div>
                        <div id="dropdown"
                            class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-400 rounded-lg shadow-lg">
                            <ul id="dropdownOptions" class="max-h-60 overflow-y-auto">
                                @foreach ($classrooms as $classroom)
                                    <li class="px-4 cursor-pointer hover:bg-blue-600 hover:rounded-lg hover:text-white"
                                        data-value="{{ $classroom->id }}" data-text="{{ $classroom->name }}">
                                        {{ $classroom->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col my-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="rounded-lg border-gray-400 mt-1 h-40">{{ old('description') }}</textarea>
                </div>
                <button type="submit"
                    class="bg-accent-1 hover:bg-gradient-to-r from-accent-1 to-accent-2 text-white py-2 px-4 flex w-full text-center justify-center font-semibold rounded-lg text-lg mt-4">Create
                    Exam</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdown = document.getElementById('dropdown');
    const dropdownOptions = document.getElementById('dropdownOptions');
    const selectedItemsContainer = document.getElementById('selectedItems');
    let selectedValues = new Set();

    dropdownButton.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent the click event from bubbling up to the document
        dropdown.classList.toggle('hidden');
    });

    dropdownOptions.addEventListener('click', function(e) {
        if (e.target.tagName === 'LI') {
            const value = e.target.getAttribute('data-value');
            const text = e.target.getAttribute('data-text');
            if (!selectedValues.has(value)) {
                selectedValues.add(value);
                updateSelectedItems();
            }
        }
    });

    function updateSelectedItems() {
        selectedItemsContainer.innerHTML = '';
        selectedValues.forEach(value => {
            const itemBox = document.createElement('div');
            itemBox.classList.add('flex', 'items-center', 'bg-accent-1', 'text-white', 'px-3', 'py-1', 'rounded-lg');
            const itemText = document.createTextNode(document.querySelector(`li[data-value="${value}"]`).getAttribute('data-text'));
            itemBox.appendChild(itemText);

            const closeButton = document.createElement('button');
            closeButton.classList.add('ml-2', 'text-white', 'focus:outline-none');
            closeButton.innerHTML = '&times;';
            closeButton.addEventListener('click', function() {
                selectedValues.delete(value);
                updateSelectedItems();
            });

            itemBox.appendChild(closeButton);
            selectedItemsContainer.appendChild(itemBox);

            // Add hidden input to form for each selected value
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'classrooms[]';
            hiddenInput.value = value;
            selectedItemsContainer.appendChild(hiddenInput);
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!dropdownButton.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Prevent dropdown from closing when clicking inside
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

    </script>
@endsection
