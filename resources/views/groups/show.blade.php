<!-- resources/views/groups/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto mt-8 p-8 bg-white dark:bg-gray-800 rounded shadow-lg">
        <h1 class="text-2xl font-semibold mb-6">{{ $group->name }}</h1>

        <!-- Display group details -->
        <div class="mb-4">
            <strong class="block text-gray-600 dark:text-gray-400">Group ID:</strong>
            <span class="text-gray-800 dark:text-gray-200">{{ $group->id }}</span>
        </div>

        <!-- Add more details as needed -->

        <div class="flex items-center mt-6">
            <a href="{{ route('groups.edit', $group) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-4">Edit</a>

            <form action="{{ route('groups.destroy', $group) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</x-app-layout>
