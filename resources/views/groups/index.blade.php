<!-- resources/views/groups/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="container mx-auto">
                        <h1 class="text-2xl font-semibold mb-6">Groups</h1>
                        <a href="{{ route('groups.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Group</a>
                        <table class="table border w-full">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border">ID</th>
                                    <th class="py-2 px-4 border">Name</th>
                                    <th class="py-2 px-4 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($groups as $group)
                                    <tr>
                                        <td class="py-2 px-4 border">{{ $group->id }}</td>
                                        <td class="py-2 px-4 border">{{ $group->name }}</td>
                                        <td class="py-2 px-4 border">
                                            <a href="{{ route('files.index', ['group_id' => $group->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">View</a>
                                            <a href="{{ route('groups.edit', $group) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                            <form action="{{ route('groups.destroy', $group) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                            <form action="{{ route('groups.addUser', $group) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                <input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md ">
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure?')">Add User</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-2 px-4 border">No groups found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
