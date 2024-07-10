@extends('layouts.app')

@section('title')
    <title>Type of Exams - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 shadow-button bg-white px-6 rounded-lg py-4">
        <h1 class="font-semibold text-lg">Edit Exam Type - {{ $examType->name }}</h1>

        <form action="{{ route('admin.exam-types.update', $examType) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Exam Type Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $examType->name) }}"
                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Exam Type</button>
            </div>
        </form>
    </div>
@endsection
