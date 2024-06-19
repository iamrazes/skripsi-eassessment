@extends('layouts.dashboard')

@section('title')
    <title>Edit Subjects - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 shadow-button bg-white px-6 rounded-lg py-4">
        <h1 class="font-semibold text-lg">Edit Subjects</h1>

        <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Subject Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $subject->name) }}"
                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Subjects</button>
            </div>
        </form>
    </div>
@endsection