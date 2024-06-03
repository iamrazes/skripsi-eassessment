@extends('layouts.dashboard')

@section('title')
<title>My Results - {{ config('app.name') }}</title>
@endsection

@section('content')

<!-- Content Here -->
<div class="rounded-xl border-2 border-accent-1 p-5 bg-white mt-8 shadow-button">
    <div class="flex flex-col items-center justify-center text-center gap-y-2.5">
        <img src="{{asset('images/img_dashboard_maleStudent.png')}}" class="w-28 h-28 mt-1" alt="">
        <h1 class="font-bold text-accent-1 uppercase text-2xl">STUDENT FULL NAME</h1>
        <span>STUDENT'S SCHOOL ID</span>
        <span>STUDENT'S CLASS</span>
    </div>
</div>
<div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4">
    <div class="flex flex-col">
        <h1 class="font-semibold px-6 pb-4 text-lg">Your Assessment Results</h1>
        <div class="overflow-x-auto">
            <table id="resultsTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Subject</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Date Assigned
                        </th>
                        <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Score</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Options</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                    <tr class="bg-white divide-gray-200">
                        <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                        <td class="px-6 py-4 whitespace-nowrap">title</td>
                        <td class="px-6 py-4 whitespace-nowrap">subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">date</td>
                        <td class="px-6 py-4 whitespace-nowrap">score</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- Pagination buttons -->
        <div id="pagination" class="flex items-center mt-4 justify-center gap-x-1 text-textColor">
            <!-- Pagination buttons will be dynamically inserted here -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                    numberingCell.textContent = (index + 1) + "."; // Add a period at the end of the number
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
                button.className = `pagination-button ${i === currentPage ? 'bg-accent-1' : 'bg-accent-3'} w-8 h-8 rounded text-white font-semibold`;
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
