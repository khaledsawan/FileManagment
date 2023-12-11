<!-- resources/views/files/create.blade.php -->

<x-app-layout>
    <div class="container mx-auto mt-8 p-8 bg-white dark:bg-gray-800 rounded shadow-lg">
        <h1 class="text-2xl font-semibold mb-6">Create File</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @php
                $groupId = session('group_id');
            @endphp
            <input type="hidden" name="group_id" value="{{ $groupId }}">

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-400">File Name</label>
                <input type="text" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-600 dark:text-gray-400">File</label>
                <input type="file" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" id="file" name="file">
            </div>

            <!-- Add more form fields as needed -->

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create File</button>
        </form>
    </div>
</x-app-layout>
