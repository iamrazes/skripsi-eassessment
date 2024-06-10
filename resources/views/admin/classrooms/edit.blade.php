@extends('layouts.dashboard')

@section('title')
    <title>Edit Classroom - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 shadow-button bg-white px-6 rounded-lg py-4">
        <h1 class="font-semibold text-lg">Edit Classroom</h1>

        <form action="{{ route('admin.classrooms.update', $classroom->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Classroom Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $classroom->name) }}"
                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Classroom</button>
            </div>
        </form>
    </div>
@endsection
