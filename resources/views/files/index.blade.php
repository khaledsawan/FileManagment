<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('File Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                $groupId = session('group_id');
                $userId = session('userId');

            @endphp
            <a href="{{ route('files.create', ['group_id' => $groupId]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create File</a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">List of Files</h3>

                <form action="{{ route('files.bulkUpdate') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($files as $file)
                        <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-4 rounded-md">
                            <input type="checkbox" name="selected_files[]" value="{{ $file->id }}" {{ $file->status == 0 ? '' : 'disabled' }}>
                            <label class="font-semibold text-lg">{{ $file->name }}</label>
                            <p>Status:
                                <span style="color: {{ $file->status == 0 ? 'green' : 'red' }}">
                                    {{ $file->status == 0 ? 'Free' : 'In Use' }}
                                </span>
                            </p>

                            @if ($file->status == $userId)
                                <a href="{{ route('files.edit', $file->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Update</a>
                            @endif

                            @if ($file->status != 0 && $userId == $file->status)
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" onclick="finishFile({{ $file->id }})">Finish</button>
                        @endif
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" onclick="return confirm('Are you sure you want to update the selected files?')">Update Selected Files</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        function finishFile(fileId) {
            console.log(fileId);
            fetch(`/files/finish`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({'file_id': fileId})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                    // Optionally, you can reload the page or update the UI dynamically
                    // window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</x-app-layout>
