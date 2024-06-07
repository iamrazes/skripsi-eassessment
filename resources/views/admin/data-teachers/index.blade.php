@extends('layouts.dashboard')

@section('title')
    <title>Teacher Database - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (session('success'))
        <div class="mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="mt-8">
        <a href="{{ route('admin.data-teachers.create') }}"
            class="flex max-w-max justify-center align-middle bg-green-500 text-center hover:bg-green-700 py-3 px-4 rounded-lg transition ease-linear shadow gap-x-2"><img
                src="{{ asset('icons/ic_create-assessment.svg') }}" alt="" class="w-6 h-6"><span
                class="text-white font-semibold ">New Teacher</span></a>
    </div>
    <div class="mt-4 bg-white shadow-button rounded-lg pb-8 pt-4">
        <div class="flex flex-col">
            <h1 class="font-semibold px-6 pb-4 text-lg">Data Teachers</h1>
            <table id="resultsTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Name</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Email</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Username</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Teacher ID</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($dataTeachers as $index => $dataTeacher)
                        <tr class="bg-white divide-gray-200">
                            <td class="pl-6 py-4 numbering-cell"></td>
                            <td class="px-6 py-4">{{ $dataTeacher->user->name }}</td>
                            <td class="px-6 py-4">{{ $dataTeacher->user->email }}</td>
                            <td class="px-6 py-4">{{ $dataTeacher->user->username }}</td>
                            <td class="px-6 py-4">{{ $dataTeacher->teacher_id }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.data-teachers.show', $dataTeacher->id) }}"
                                    class="text-gray-500 hover:text-gray-600">Preview</a>
                                <a href="{{ route('admin.data-teachers.edit', $dataTeacher->id) }}"
                                    class="text-blue-600 hover:text-blue-900 ml-2">Edit</a>
                                <form action="{{ route('admin.data-teachers.destroy', $dataTeacher->id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                </form>
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
