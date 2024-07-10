@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="mt-8 bg-white shadow-button rounded-lg mx-4 lg:mx-0 hidden lg:block">
        <div class="flex flex-col">
            <div class="flex flex-col p-4 lg:py-6 lg:px-8">

                <h1 class="font-semibold text-xl flex gap-x-2"><img src="{{ asset('icons/ic_assessment-history.svg') }}"
                        alt="">Exams History</h1>
                <p class="text-xs lg:text-sm mt-1 lg:w-1/2">These are your exams history including drafts, published and
                    completed. Click
                    view button to see the details.</p>
            </div>

            <div class="">
                <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200" id="customTable">
                    <thead class="bg-gray-50 ">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th class=" lg:py-3 pl-3 text-left font-medium ">Title</th>
                            <th class=" lg:py-3 text-left font-medium line-clamp-1">Type of Exam</th>
                            <th class=" lg:py-3 text-left font-medium">Subject</th>
                            <th class=" lg:py-3 text-left font-medium ">Date</th>
                            <th class=" lg:py-3 text-left font-medium line-clamp-1">Assigned To</th>
                            <th class=" lg:py-3 text-left font-medium">Status</th>
                            <th class="pr-6 lg:py-3 text-right font-medium w-42">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($exams as $exam)
                            <tr>
                                <td class=" pl-6 text-left w-6 numbering-cell"></td>
                                <td class=" pl-3 text-left ">{{ $exam->title }}</td>
                                <td class=" text-left ">{{ $exam->examType->name }}</td>
                                <td class=" text-left ">{{ $exam->subject->name }}</td>
                                <td class=" text-left ">{{ $exam->date->format('Y-m-d') }}</td>
                                <td class="  text-left ">
                                    @foreach ($exam->classrooms as $classroom)
                                        {{ $classroom->name }} @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class=" text-left capitalize">{{ $exam->status }}</td>
                                <td class="pr-6 py-2 flex flex-auto justify-end lg:gap-x-2 gap-x-1">
                                    <form action="{{ route('teacher.exams.destroy', $exam->id) }}" method="POST"
                                        id="deleteExam" class="shrink-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class=" bg-red-200 hover:bg-red-300 rounded-lg p-1 items-center"><img
                                                src="{{ asset('icons/ic_delete.svg') }}"></button>
                                    </form>
                                    <a href="{{ route('teacher.exams.show', $exam->id) }}"
                                        class="bg-gray-300 hover:bg-gray-400 rounded-lg p-1 items-center shrink-0 grow-0"><img
                                            src="{{ asset('icons/ic_views.svg') }}"></a>
                                    <a href="{{ route('teacher.exams.edit', $exam->id) }}"
                                        class="bg-blue-100 hover:bg-blue-200 rounded-lg p-1 items-center shrink-0 grow-0"><img
                                            src="{{ asset('icons/ic_edit.svg') }}"></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination buttons -->
                <div id="pagination" class="flex items-center my-4 justify-center gap-x-1 text-textColor">
                </div>
            </div>

        </div>
    </div>
@endsection



@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemsPerPage = 10;
            let currentPage = 1;

            const table = document.getElementById('customTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const totalPages = Math.ceil(rows.length / itemsPerPage);

            function renderTable(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                rows.forEach((row, index) => {
                    const numberingCell = row.querySelector('.numbering-cell');
                    if (index >= start && index < end) {
                        row.style.display = '';
                        numberingCell.textContent = (index + 1) +
                            "."; // Add a period at the end of the number
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
                        `pagination-button ${i === currentPage ? 'bg-accent-1' : 'bg-accent-3'} w-8 h-8 hover:bg-accent-1 transition rounded text-white font-semibold`;
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