@extends('layouts.app')

@section('title')
    <title>Exam - {{ $exam->title }}</title>
@endsection

@section('content')
    <div class="mt-4 bg-white rounded-lg py-4 shadow-button mx-4 lg:mx-0">
        <div class="flex justify-between border-b pb-2 px-6 mb-4">
            <h1 class="text-xl font-medium">Exam Details</h1>
            <div class="flex gap-x-2 items-center">
                {{-- Buttons for managing exam status can go here --}}
            </div>
        </div>
        <div class="flex justify-between px-6">
            <div class="flex-grow">
                <h5 class="mb-2">{{ $exam->title }}</h5>
                <div class="grid lg:grid-cols-3 row-span-4">
                    <p><strong>Exam Type</strong> : {{ $exam->examType->name }}</p>
                    <p><strong>Subject</strong> : {{ $exam->subject->name }}</p>
                    <p><strong>Date</strong> : {{ $exam->date->format('Y-m-d') }}</p>
                    <p><strong>Start Time</strong> : {{ $exam->start_time }}</p>
                    <p><strong>Duration</strong> : {{ $exam->duration }} minutes</p>
                    <p><strong>Total Questions</strong> : {{ $exam->total_questions }}</p>
                    <p><strong>Classrooms</strong> :
                        @foreach ($exam->classrooms as $classroom)
                            {{ $classroom->name }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </p>
                    <p class="capitalize"><strong>Status</strong> : {{ $exam->status }}</p>
                    <p><strong>Description</strong> : {{ $exam->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex gap-4 mt-4 -mb-4 mx-4 lg:mx-0">
        <button id="questionnaireButton" class="px-3 py-2 shadow-sm rounded-lg font-semibold text-sm w-full lg:w-max">Questionnaire</button>
        <button id="studentAnswerButton" class="px-3 py-2 shadow-sm rounded-lg font-semibold text-sm w-full lg:w-max">Student Answer</button>
    </div>

    <div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4 mx-4 lg:mx-0" id="questions">
        <div class="flex flex-col">
            <div class="flex justify-between px-6 pb-4">
                <h1 class="font-semibold text-lg">Questionnaire</h1>
                {{-- Manage Question button can go here --}}
            </div>
            <div class="overflow-x-auto">
                <table id="resultsTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                    <thead class="bg-gray-5">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Questions</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Answer</th>
                            {{-- Options column can go here --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($exam->questions as $index => $question)
                            <tr class="bg-white divide-gray-200">
                                <td class="pl-6 py-2 whitespace-nowrap numbering-cell w-6"></td>
                                <td class="px-6 py-2 whitespace-nowrap lg:max-w-screen-sm max-w-20 overflow-hidden">
                                    {{ $question->question_text }}</td>
                                <td class="px-6 py-2 whitespace-nowrap lg:max-w-screen-sm max-w-20 overflow-hidden">
                                    @if ($question->choices->contains('is_correct', true))
                                        @php
                                            $alphabet = ['a', 'b', 'c', 'd', 'e'];
                                        @endphp
                                        @foreach ($question->choices as $index => $choice)
                                            @if ($choice->is_correct)
                                                {{ $alphabet[$index] }}. {{ $choice->choice_text }}
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                {{-- Edit button can go here --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination buttons -->
            <div id="pagination" class="flex items-center mt-4 justify-center gap-x-1">
                <!-- Pagination buttons will be dynamically inserted here -->
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4 mx-4 lg:mx-0 hidden" id="studentAnswers">
        <div class="flex flex-col">
            <div class="flex justify-between px-6 pb-4">
                <h1 class="font-semibold text-lg">Student Answers</h1>
            </div>
            <div class="overflow-x-auto">
                <table id="answersTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                    <thead class="bg-gray-5">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium w-32">ID</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Name</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Classroom</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Score</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Options</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($studentReports as $index => $report)
                            <tr class="bg-white divide-gray-200">
                                <td class="pl-6 py-2 whitespace-nowrap numbering-cell w-6"></td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $report->student->dataStudent->student_id }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $report->student->name }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap w-10">
                                    {{ $report->student->dataStudent->classroom->name }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap w-10">
                                    {{ $report->score }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-end w-20">
                                    <a href="{{ route('teacher.history.answer', ['exam' => $exam->id, 'id' => $report->student->id]) }}"
                                        class="text-blue-500 hover:underline">View Answer Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination buttons -->
            <div id="pagination2" class="flex items-center mt-4 justify-center gap-x-1">
                <!-- Pagination buttons will be dynamically inserted here -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pagination script
            const itemsPerPage = 20;
            let currentPage = 1;

            const table = document.getElementById('answersTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const totalPages = Math.ceil(rows.length / itemsPerPage);

            function renderTable(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                rows.forEach((row, index) => {
                    const numberingCell = row.querySelector('.numbering-cell');
                    if (index >= start && index < end) {
                        row.style.display = '';
                        numberingCell.textContent = (index + 1) + ".";
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function createPagination() {
                const paginationContainer = document.getElementById('pagination2');
                paginationContainer.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;
                    button.classList.add('px-4', 'py-2', 'rounded-lg', 'font-semibold', 'mx-1');
                    if (i === currentPage) {
                        button.classList.add('bg-accent-1', 'text-white');
                    } else {
                        button.classList.add('bg-white', 'border', 'border-accent-1');
                    }
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTable(currentPage);
                        createPagination();
                    });
                    paginationContainer.appendChild(button);
                }
            }

            renderTable(currentPage);
            createPagination();

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pagination script
            const itemsPerPage = 20;
            let currentPage = 1;

            const table = document.getElementById('resultsTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const totalPages = Math.ceil(rows.length / itemsPerPage);

            function renderTable(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                rows.forEach((row, index) => {
                    const numberingCell = row.querySelector('.numbering-cell');
                    if (index >= start && index < end) {
                        row.style.display = '';
                        numberingCell.textContent = (index + 1) + ".";
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function createPagination() {
                const paginationContainer = document.getElementById('pagination');
                paginationContainer.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;
                    button.classList.add('px-4', 'py-2', 'rounded-lg', 'font-semibold', 'mx-1');
                    if (i === currentPage) {
                        button.classList.add('bg-accent-1', 'text-white');
                    } else {
                        button.classList.add('bg-white', 'border', 'border-accent-1');
                    }
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTable(currentPage);
                        createPagination();
                    });
                    paginationContainer.appendChild(button);
                }
            }

            renderTable(currentPage);
            createPagination();

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionnaireButton = document.getElementById('questionnaireButton');
            const studentAnswerButton = document.getElementById('studentAnswerButton');
            const questionsDiv = document.getElementById('questions');
            const studentAnswersDiv = document.getElementById('studentAnswers');

            // Function to show the questionnaire table and hide the student answers table
            function showQuestionnaire() {
                questionsDiv.classList.remove('hidden');
                studentAnswersDiv.classList.add('hidden');
                questionnaireButton.classList.add('bg-accent-1', 'text-white');
                questionnaireButton.classList.remove('bg-gray-300', 'text-gray-700');
                studentAnswerButton.classList.remove('bg-accent-1', 'text-white');
                studentAnswerButton.classList.add('bg-gray-300', 'text-gray-700');
            }

            // Function to show the student answers table and hide the questionnaire table
            function showStudentAnswers() {
                studentAnswersDiv.classList.remove('hidden');
                questionsDiv.classList.add('hidden');
                studentAnswerButton.classList.add('bg-accent-1', 'text-white');
                studentAnswerButton.classList.remove('bg-gray-300', 'text-gray-700');
                questionnaireButton.classList.remove('bg-accent-1', 'text-white');
                questionnaireButton.classList.add('bg-gray-300', 'text-gray-700');
            }

            // Add event listeners to the buttons
            questionnaireButton.addEventListener('click', showQuestionnaire);
            studentAnswerButton.addEventListener('click', showStudentAnswers);

            // Default to showing the questionnaire
            showQuestionnaire();

        });
    </script>
@endsection
