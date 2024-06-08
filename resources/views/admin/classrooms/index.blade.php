@extends('layouts.dashboard')

@section('title')
    <title>Classrooms - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (session('success'))
        <div class="mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="mt-8 shadow-button bg-white px-6 rounded-lg pt-4 pb-6">
        <label for="name" class="block font-semibold text-gray-700">Classroom Name</label>
        <form action="{{ route('admin.classrooms.store') }}" method="POST" class="flex items-center gap-4">
            @csrf
            <div class="flex-1">
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-10">
            </div>
            <div class="flex-shrink-0">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-1 rounded-md h-10">Create
                    Classroom</button>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white shadow-button rounded-lg pb-8 pt-4">
        <h1 class="font-semibold px-6 pb-4 text-lg">Classrooms</h1>

        <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200" id="resultsTable">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 text-right font-medium w-42">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($classrooms as $index => $classroom)
                    <tr>
                        <td class="pl-6 py-4 numbering-cell"></td>
                        <td class="px-6 py-4">{{ $classroom->name }}</td>
                        <td class="px-6 py-4 flex gap-x-2 justify-end items-center">
                            <a href="{{ route('admin.classrooms.show', $classroom->id) }}"
                                class="bg-gray-300 hover:bg-gray-400 rounded-lg p-1 items-center"><img
                                    src="{{ asset('icons/ic_views.svg') }}"></a>
                            <a href="{{ route('admin.classrooms.edit', $classroom->id) }}"
                                class="bg-blue-100 hover:bg-blue-200 rounded-lg p-1 items-center"><img
                                    src="{{ asset('icons/ic_edit.svg') }}"></a>
                            <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="items-center bg-red-200 hover:bg-red-300 p-1 rounded-lg flex"><img
                                        src="{{ asset('icons/ic_delete.svg') }}"></button>
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
