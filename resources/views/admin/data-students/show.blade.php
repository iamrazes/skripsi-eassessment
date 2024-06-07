@extends('layouts.dashboard')

@section('title')
    <title>Student Database - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 mb-6 bg-white shadow-button rounded-lg pb-8 pt-4">
        <div class="flex flex-col">
            <h1 class="font-semibold text-lg px-6 pb-4 flex gap-x-2"><img src="{{ asset('icons/ic_student.svg') }}" alt=""><span>Data Student</span></h1>
            <div class="overflow-x-auto">
                <table class="min-w-full ">
                    <tbody class="bg-white divide-y border-y">
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Username</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $student->user->username }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Name</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $student->user->name }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Email</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $student->user->email }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Gender</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ ucfirst($student->gender) }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Birthdate</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $student->birthdate }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Student ID</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $student->student_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
