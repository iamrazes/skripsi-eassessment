@extends('layouts.dashboard')

@section('title')
<title>Review Assessment - {{ config('app.name') }}</title>
@endsection

@section('content')

<div
class="flex mt-8 bg-gradient-to-r from-accent-1 to-accent-2 shadow-button py-4 px-5 text-center rounded-lg text-white font-medium gap-x-2 text-2xl">
<img src="{{asset('icons/ic_assessment-review.svg')}}" alt="" class="filter-white">
<span>Review Assessment</span>
</div>

<!-- Ongoing -->
<div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4">
<div class="flex flex-col">
    <h1 class="px-6 font-medium pb-2 text-lg">Unassigned Assessment</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="pl-6  py-3 text-left font-medium w-6">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Options
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap">1</td>
                    <td class="px-6 py-4 whitespace-nowrap">Ulangan Harian</td>
                    <td class="px-6 py-4 whitespace-nowrap">Matematika</td>
                    <td class="px-6 py-4 whitespace-nowrap">Unassigned</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-accent-1 pl-4">Edit</span>
                    </td>
                </tr>
                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap">2</td>
                    <td class="px-6 py-4 whitespace-nowrap">Ulangan Harian</td>
                    <td class="px-6 py-4 whitespace-nowrap">Matematika</td>
                    <td class="px-6 py-4 whitespace-nowrap">Unassigned</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-accent-1 pl-4">Edit</span>
                    </td>
                </tr>
                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap">3</td>
                    <td class="px-6 py-4 whitespace-nowrap">Ulangan Harian</td>
                    <td class="px-6 py-4 whitespace-nowrap">Matematika</td>
                    <td class="px-6 py-4 whitespace-nowrap">Unassigned</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-accent-1 pl-4">Edit</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- Unassigned -->
<div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4">
<div class="flex flex-col">
    <h1 class="px-6 font-medium pb-2 text-lg">Ongoing Assessment</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="pl-6  py-3 text-left font-medium w-6">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Date of Test
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">
                        Options
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap">1</td>
                    <td class="px-6 py-4 whitespace-nowrap">Ulangan Harian</td>
                    <td class="px-6 py-4 whitespace-nowrap">Matematika</td>
                    <td class="px-6 py-4 whitespace-nowrap">Assigned</td>
                    <td class="px-6 py-4 whitespace-nowrap">08/05/2024</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-accent-1 pl-4">Edit</span>
                    </td>
                </tr>
                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap">2</td>
                    <td class="px-6 py-4 whitespace-nowrap">Ulangan Harian</td>
                    <td class="px-6 py-4 whitespace-nowrap">Matematika</td>
                    <td class="px-6 py-4 whitespace-nowrap">Assigned</td>
                    <td class="px-6 py-4 whitespace-nowrap">08/05/2024</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-accent-1 pl-4">Edit</span>
                    </td>
                </tr>
                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap">3</td>
                    <td class="px-6 py-4 whitespace-nowrap">Ulangan Harian</td>
                    <td class="px-6 py-4 whitespace-nowrap">Matematika</td>
                    <td class="px-6 py-4 whitespace-nowrap">Assigned</td>
                    <td class="px-6 py-4 whitespace-nowrap">08/05/2024</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-accent-1 pl-4">Edit</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- Completed -->
<div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4">
<div class="flex flex-col">
    <h1 class="font-semibold px-6 pb-4 text-lg">Your Assessment History</h1>
    <div class="overflow-x-auto">
        <table id="resultsTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Subject</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Date Assigned
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Options</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>

                <tr class="bg-white divide-gray-200">
                    <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                    <td class="px-6 py-4 whitespace-nowrap">title</td>
                    <td class="px-6 py-4 whitespace-nowrap">subject</td>
                    <td class="px-6 py-4 whitespace-nowrap">date</td>
                    <td class="px-6 py-4 whitespace-nowrap">status</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/src/result-review-1.html" class="font-bold text-accent-1">Review</a>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
    <!-- Pagination buttons -->
    <div id="pagination" class="flex items-center mt-4 justify-center gap-x-1">
        <!-- Pagination buttons will be dynamically inserted here -->
    </div>
</div>
</div>
<!-- Spacer to push footer to bottom -->
<div class="flex-grow"></div>
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
                    numberingCell.textContent = index + 1; // Correct the row number
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
