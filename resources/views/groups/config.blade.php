<!-- resources/views/groups/edit.blade.php -->

<x-app-layout>
    <div class="container mx-auto mt-8 p-8 bg-white dark:bg-gray-800 rounded shadow-lg">
        <h1 class="text-2xl font-semibold mb-6">Update Group</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('groups.update', $group) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Group Name</label>
                <input  type="text" disabled=true class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" id="name" name="name" value="{{ old('name', $group->name) }}">
            </div>
            <div class="mb-4">
                <label for="user_id_creater" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Group files count</label>
                <input type="number" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" id="files_count" name="files_count" value="{{ old('files_count', $group->files_count) }}">
            </div>
            <div class="mb-4">
                <label for="file_size" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Group max file size</label>
                <input type="number" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" id="file_size" name="file_size" value="{{ old('file_size', $group->file_size) }}">
            </div>



            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Group</button>
        </form>
    </div>
</x-app-layout>
