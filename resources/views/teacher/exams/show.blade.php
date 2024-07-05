@extends('layouts.app')

@section('title')
    <title>Exam - {{ $exam->title }}</title>
@endsection

@section('content')
    <div class="mt-4 bg-white rounded-lg py-4 shadow-button ">
        <div class="flex justify-between border-b pb-2 px-6 mb-4">
            <h1 class="text-xl font-medium  ">Exam Details</h1>

            <a href="{{ route('teacher.exams.edit', $exam->id) }}"
                class="bg-blue-100 hover:bg-blue-200 rounded-lg p-1 items-center"><img
                    src="{{ asset('icons/ic_edit.svg') }}"></a>
        </div>
        <div class="flex justify-between px-6">
            <div class="flex-grow">
                <h5 class="mb-2">{{ $exam->title }}</h5>
                <div class="grid lg:grid-cols-3 row-span-4">
                    <p class=""><strong>Exam Type</strong> : {{ $exam->examType->name }}</p>
                    <p class=""><strong>Subject</strong> : {{ $exam->subject->name }}</p>
                    <p class=""><strong>Date</strong> : {{ $exam->date->format('Y-m-d') }}</p>
                    <p class=""><strong>Start Time</strong> : {{ $exam->start_time }}</p>
                    <p class=""><strong>Duration</strong> : {{ $exam->duration }} minutes</p>
                    <p class=""><strong>Total Questions</strong> : {{ $exam->total_questions }}</p>
                    <p class=""><strong>Classrooms</strong> :
                        @foreach ($exam->classrooms as $classroom)
                            {{ $classroom->name }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </p>
                    <p class="capitalize"><strong>Status</strong> : {{ $exam->status }}</p>
                    <p class=""><strong>Description</strong> : {{ $exam->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4">
        <div class="flex flex-col">
            <div class="flex justify-between px-6 pb-4 ">
                <h1 class="font-semibold text-lg">Questionnaire</h1>
                <a href="{{ route('teacher.exams.questions.create', $exam->id) }}"
                    class="text-md text-accent-1 hover:text-blue-700">Manage Question</a>
            </div>
            <div class="overflow-x-auto">
                <table id="resultsTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200 ">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider flex-grow">Questions
                            </th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Answer</th>
                            <th scope="col" class="px-6 py-3 text-end font-medium tracking-wider">Options</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($exam->questions as $index => $question)
                            <tr class="bg-white divide-gray-200">
                                <td class="pl-6 py-1 whitespace-nowrap numbering-cell"></td>
                                <td class="px-6 py-1 whitespace-nowrap max-w-screen-sm overflow-hidden">
                                    {{ $question->question_text }}</td>
                                <td class="px-6 py-1 whitespace-nowrap max-w-screen-sm overflow-hidden">
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
                                <td class="pr-6 py-2 flex flex-auto justify-end ">

                                    <a href="{{ route('teacher.exams.questions.create', [$exam->id, $question->id]) }}"
                                        class="bg-blue-100 hover:bg-blue-200 rounded-lg p-1 items-center shrink-0 grow-0"><img
                                            src="{{ asset('icons/ic_edit.svg') }}">
                                    </a>

                                </td>
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
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            function renderPaginationButtons() {
                const paginationContainer = document.getElementById('pagination');
                paginationContainer.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.className =
                        `pagination-button ${i === currentPage ? 'bg-accent-1' : 'bg-accent-3'} w-8 h-8 rounded text-white font-semibold`;
                    button.innerText = i;
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTable(currentPage);
                        updatePaginationButtons();
                    });
                    paginationContainer.appendChild(button);
                }
            }

            function updatePaginationButtons() {
                const paginationButtons = document.querySelectorAll('.pagination-button');
                paginationButtons.forEach(button => {
                    if (parseInt(button.innerText) === currentPage) {
                        button.classList.remove('bg-accent-3');
                        button.classList.add('bg-accent-1');
                    } else {
                        button.classList.remove('bg-accent-1');
                        button.classList.add('bg-accent-3');
                    }
                });
            }

            renderTable(currentPage);
            renderPaginationButtons();
        });
    </script>
@endsection
