@extends('layouts.app')

@section('title')
    <title>Classrooms - {{ config('app.name') }}</title>
@endsection

@section('content')

    <div class="flex bg-white flex-col rounded-lg shadow-button mt-8">

        <h1 class="font-semibold px-6 pt-4 text-lg">Classrooms</h1>

        <div class="mt-4 rounded-lg pb-8">
            <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200" id="resultsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Class</th>
                        <th scope="col" class="px-6 py-3 text-right font-medium w-42"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($classrooms as $index => $classroom)
                        <tr>
                            <td class="pl-6 py-4 numbering-cell"></td>
                            <td class="px-6 py-4">{{ $classroom->name }}</td>
                            <td class="px-6 py-4 flex gap-x-2 justify-end items-center">
                                <a href="{{ route('teacher.classrooms.teacherShow', $classroom->id) }}"
                                    class="bg-gray-300 hover:bg-gray-400 rounded-lg p-1 items-center flex px-2 gap-x-1"><img
                                        src="{{ asset('icons/ic_views.svg') }}">View Class Member</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination buttons -->
            <div id="pagination" class="flex items-center mt-4 justify-center gap-x-1 text-textColor">
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
