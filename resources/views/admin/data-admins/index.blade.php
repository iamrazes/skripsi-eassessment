@extends('layouts.dashboard')

@section('title')
    <title>Admin Database - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (session('success'))
        <div class="mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="mt-8">
        <a href="{{ route('admin.data-admins.create') }}"
            class="flex max-w-max justify-center align-middle bg-green-500 text-center hover:bg-green-700 py-3 px-4 rounded-lg transition ease-linear shadow gap-x-2"><img
                src="{{ asset('icons/ic_create-assessment.svg') }}" alt="" class="w-6 h-6"><span
                class="text-white font-semibold ">New Admin</span></a>
    </div>
    <div class="mt-4 bg-white shadow-button rounded-lg pb-8 pt-4">
        <div class="flex flex-col">
            <h1 class="font-semibold px-6 pb-4 text-lg">Database - Data Admins</h1>
            <div class="overflow-auto">
                <table id="resultsTable" class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                    <thead class="bg-white">
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-left font-medium w-6">No.</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Username</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">NUPTK</th>
                            <th scope="col" class="px-6 py-3 text-left font-medium tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($dataAdmins as $index => $dataAdmin)
                            <tr class="bg-white divide-gray-200">
                                <td class="pl-6 py-4 whitespace-nowrap numbering-cell"></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $dataAdmin->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $dataAdmin->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $dataAdmin->user->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $dataAdmin->contact }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $dataAdmin->nuptk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.data-admins.show', $dataAdmin->id) }}"
                                        class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-1 px-2 rounded">Preview</a>
                                    <a href="{{ route('admin.data-admins.edit', $dataAdmin->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                    <form action="{{ route('admin.data-admins.destroy', $dataAdmin->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
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
