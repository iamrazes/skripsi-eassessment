@extends('layouts.dashboard')

@section('title')
@endsection

@section('content')
    <div class="mt-8 bg-white rounded-lg shadow-button px-8 py-6">
        <div class="flex justify-between">
            <div class="flex flex-col w-1/2">
                <h1 class="font-semibold text-2xl">Assessments</h1>
                <p class="text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nobis voluptates
                    laboriosam ullam magnam
                    necessitatibus aut minus omnis asperiores nam eveniet, natus eaque ipsa error accusamus fugiat beatae.
                </p>
            </div>

            <div class="flex flex-col">
                <a href=""
                    class="bg-accent-1 rounded-lg py-2 px-4 gap-x-3 w-56 text-start font-medium text-white flex hover:bg-gradient-to-r from-accent-1 to-accent-2"><img
                        src="{{ asset('icons/ic_assessment.svg') }}" class="filter-white">Create New Exam</a>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow-button rounded-lg px-8 py-6">
        <div class="flex flex-col">
            <h1 class="font-semibold text-xl">Exams In Progress</h1>
            <p class="text-sm mt-1 w-1/2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis excepturi
                quis vero accusantium ipsam distinctio id similique facere ullam sed ab, harum tempore. Incidunt, similique.
                Nobis ipsam dolorum velit ut.</p>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex flex-col gap-y-2">
                        <h1 class="line-clamp-2 text-lg font-medium">E-Assessment - Type of Exam - Subject - DD/MM/YYYY</h1>
                        <div class="flex gap-x-3 text-sm">
                            <div class="flex flex-col">
                                <span>Subject:</span>
                                <span>Classroom:</span>
                                <span>Date Assigned:</span>
                                <span>Status:</span>
                            </div>
                            <div class="flex flex-col">
                                <span>Subject</span>
                                <span>12 A, 12</span>
                                <span>DD/MM/YYYY</span>
                                <span>In Progress</span>
                            </div>
                        </div>
                        <a href=""
                            class="bg-accent-1 rounded-lg text-white font-medium text-center py-2 hover:bg-gradient-to-r from-accent-1 to-accent-2 ">Continue</a>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex flex-col gap-y-2">
                        <h1 class="line-clamp-2 text-lg font-medium">E-Assessment - Type of Exam - Subject - DD/MM/YYYY</h1>
                        <div class="flex gap-x-3 text-sm">
                            <div class="flex flex-col">
                                <span>Subject:</span>
                                <span>Classroom:</span>
                                <span>Date Assigned:</span>
                                <span>Status:</span>
                            </div>
                            <div class="flex flex-col">
                                <span>Subject</span>
                                <span>12 A, 12</span>
                                <span>DD/MM/YYYY</span>
                                <span>In Progress</span>
                            </div>
                        </div>
                        <a href=""
                            class="bg-accent-1 rounded-lg text-white font-medium text-center py-2 hover:bg-gradient-to-r from-accent-1 to-accent-2 ">Continue</a>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex flex-col gap-y-2">
                        <h1 class="line-clamp-2 text-lg font-medium">E-Assessment - Type of Exam - Subject - DD/MM/YYYY</h1>
                        <div class="flex gap-x-3 text-sm">
                            <div class="flex flex-col">
                                <span>Subject:</span>
                                <span>Classroom:</span>
                                <span>Date Assigned:</span>
                                <span>Status:</span>
                            </div>
                            <div class="flex flex-col">
                                <span>Subject</span>
                                <span>12 A, 12</span>
                                <span>DD/MM/YYYY</span>
                                <span>In Progress</span>
                            </div>
                        </div>
                        <a href=""
                            class="bg-accent-1 rounded-lg text-white font-medium text-center py-2 hover:bg-gradient-to-r from-accent-1 to-accent-2 ">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow-button rounded-lg  py-6">
        <div class="flex flex-col ">
            <h1 class="font-semibold text-xl px-8">Exams History</h1>
            <p class="text-sm mt-1 w-1/2 px-8">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis excepturi
                quis vero accusantium ipsam distinctio id similique facere ullam sed ab, harum tempore. Incidunt, similique.
                Nobis ipsam dolorum velit ut.</p>

            <div class="mt-4 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200" id="resultsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Name</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Type of Exam</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium">Date</th>
                            <th scope="col" class="px-6 py-3 text-right font-medium w-42">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td scope="col" class="px-6 py-3 text-left font-medium w-6">1</td>
                                <td scope="col" class="px-6 py-3 text-left font-medium ">1</td>
                                <td scope="col" class="px-6 py-3 text-left font-medium ">1</td>
                                <td scope="col" class="px-6 py-3 text-left font-medium ">1</td>
                                <td scope="col" class="px-6 py-3 text-end font-medium ">1</td>
                            </tr>
                    </tbody>
                </table>
                <!-- Pagination buttons -->
                <div id="pagination" class="flex items-center mt-4 justify-center gap-x-1 text-textColor">
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
