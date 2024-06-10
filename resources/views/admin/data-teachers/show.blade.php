@extends('layouts.dashboard')

@section('title')
    <title>Teacher Database - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 mb-6 bg-white shadow-button rounded-lg pb-8 pt-4">
        <div class="flex flex-col">
            <h1 class="font-semibold text-lg px-6 pb-4 flex gap-x-2"><img src="{{asset('icons/ic_teacher.svg')}}" alt=""><span>Data Teacher</span></h1>
            <div class="overflow-x-auto">

                <table class="min-w-full ">
                    <tbody class="bg-white divide-y border-y">
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Username</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $teacher->user->username }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Name</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $teacher->user->name }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Email</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $teacher->user->email }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Contact</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $teacher->contact }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Address</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $teacher->address }}</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="px-6 py-2 whitespace-nowrap font-medium">Teacher ID</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $teacher->teacher_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
