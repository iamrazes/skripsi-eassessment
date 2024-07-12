@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <button></button>
        </div>
    @endif
    <div class="mt-8 bg-white shadow-button rounded-lg mx-4 lg:mx-0 h-screen">
        <div class="flex flex-col">
            <div class="flex flex-col p-4 lg:py-6 lg:px-6">
                <h1 class="font-semibold text-xl flex gap-x-2">
                    <img src="{{ asset('icons/ic_assessment-history.svg') }}" alt="">
                    Exams History
                </h1>
                <p class="text-xs lg:text-sm mt-1 lg:w-1/2">These are your exams history including drafts, published and completed. Click view button to see the details.</p>
            </div>

            <div class="">
                <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200" id="customTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th class="lg:py-3 pl-3 text-left font-medium">Type of Exam</th>
                            <th class="lg:py-3 text-left font-medium">Subject</th>
                            <th class="lg:py-3 text-left font-medium">Date</th>
                            <th class="lg:py-3 text-left font-medium">Assigned To</th>
                            <th class="lg:py-3 text-left font-medium">Status</th>
                            <th class="pr-6 lg:py-3 text-right font-medium w-42">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($exams as $exam)
                            <tr>
                                <td class="pl-6 py-3 text-left w-6 numbering-cell"></td>
                                <td class="pl-3 text-left">{{ $exam->examType->name }}</td>
                                <td class="text-left">{{ $exam->subject->name }}</td>
                                <td class="text-left">{{ $exam->date->format('Y-m-d') }}</td>
                                <td class="text-left">
                                    @foreach ($exam->classrooms as $classroom)
                                        {{ $classroom->name }} @if (!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="text-left capitalize">{{ $exam->status }}</td>
                                <td class="pr-6 pt-2 flex flex-auto justify-end lg:gap-x-2 gap-x-1">
                                    <button type="button"
                                        class="bg-red-200 hover:bg-red-300 rounded-lg p-1 items-center delete-button"
                                        data-exam-id="{{ $exam->id }}">
                                        <img src="{{ asset('icons/ic_delete.svg') }}">
                                    </button>
                                    <a href="{{ route('teacher.history.show', $exam->id) }}"
                                        class="bg-gray-300 hover:bg-gray-400 rounded-lg p-1 items-center shrink-0 grow-0">
                                        <img src="{{ asset('icons/ic_views.svg') }}">
                                    </a>
                                    <a href="{{ route('teacher.history.edit', $exam->id) }}"
                                        class="bg-blue-100 hover:bg-blue-200 rounded-lg p-1 items-center shrink-0 grow-0">
                                        <img src="{{ asset('icons/ic_edit.svg') }}">
                                    </a>
                                    <form action="{{ route('teacher.exams.destroy', $exam->id) }}" method="POST" class="hidden delete-form">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination buttons -->
                <div id="pagination" class="flex items-center my-4 justify-center gap-x-1 text-textColor"></div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Exam
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete this exam? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="confirmDelete" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>
                <button id="cancelDelete" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    button.className = `pagination-button ${i === currentPage ? 'bg-accent-1' : 'bg-accent-3'} w-8 h-8 hover:bg-accent-1 transition rounded text-white font-semibold`;
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

            // Modal logic
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('deleteModal');
            const confirmDeleteButton = document.getElementById('confirmDelete');
            const cancelDeleteButton = document.getElementById('cancelDelete');
            let deleteForm = null;

            deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const examId = e.currentTarget.dataset.examId;
                    deleteForm = document.querySelector(`form[action$="${examId}"]`);
                    deleteModal.classList.remove('hidden');
                });
            });

            confirmDeleteButton.addEventListener('click', () => {
                if (deleteForm) {
                    deleteForm.submit();
                }
            });

            cancelDeleteButton.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
            });
        });
    </script>
@endsection
