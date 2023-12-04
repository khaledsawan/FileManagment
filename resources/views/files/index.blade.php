<!-- resources/views/files/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('File Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">List of Files</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($files as $file)
                        <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-4 rounded-md">
                            <h4 class="font-semibold text-lg">{{ $file->name }}</h4>
                            <p>Status:
                                <span style="color: {{ $file->status == 0 ? 'green' : 'red' }}">
                                    {{ $file->status == 0 ? 'Free' : 'In Use' }}
                                </span>
                            </p>
                            <p>Path: {{ $file->path }}</p>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
