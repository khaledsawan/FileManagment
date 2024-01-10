<x-app-layout>
    <div class="container mx-auto mt-8 p-4 sm:p-8 bg-white dark:bg-gray-800 rounded shadow-lg">
        <h1 class="text-2xl font-semibold mb-6">Report Group</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="p-4 sm:p-8">
            <p class="text-lg font-semibold mb-4">
                Group Name: {{ $group->name }}
                <br>
                Group Files Count: {{ $filesCount }}
            </p>

            <h2 class="text-xl font-semibold mt-6 mb-4">User List</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-2 px-4 border-b">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <h2 class="text-xl font-semibold mt-6 mb-4">Reports</h2>
            <div class="mt-4">
                @if(!$reports->isEmpty())
                    <a href="{{ route('reports.pdf', ['group' => $group]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Download PDF
                    </a>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Message</th>
                            <th class="py-2 px-4 border-b">Created At</th>
                            <th class="py-2 px-4 border-b">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $report->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $report->message }}</td>
                                <td class="py-2 px-4 border-b">{{ $report->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="py-2 px-4 border-b">{{ $report->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-2 px-4 border-b">No reports available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
