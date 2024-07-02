@extends('layouts.app')

@section('title')
    <title>Classroom Details - {{ $classroom->name }} - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 bg-white shadow-button rounded-lg pb-8 pt-4">
        <h1 class="font-semibold px-6 pb-4 text-lg">Classroom Details - {{ $classroom->name }}</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left font-medium">No</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Name</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Student ID</th>
                        <th scope="col" class="px-6 py-3 text-left font-medium">Username</th>
                        <th scope="col" class="px-6 py-3 text-right font-medium ">Options</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($classroom->students as $index => $student)
                        <tr>
                            <td class="px-6 py-4 w-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $student->user->name }}</td>
                            <td class="px-6 py-4">{{ $student->student_id }}</td>
                            <td class="px-6 py-4">{{ $student->user->username }}</td>
                            <td class="px-6 py-4 text-right "><a class="text-blue-600 hover:text-blue-900" href="{{ route('admin.data-students.show', $student->id) }}">More
                                    Details</a></td>

                            <!-- Add more columns as needed -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
