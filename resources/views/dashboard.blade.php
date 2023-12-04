<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-green-900 dark:text-gray-100">
            <a href="{{ route('groups.index') }}" class="text-green-500 hover:text-underline mt-4 inline-block">
                View All Groups
            </a>
        </div>
    </div>
</x-app-layout>
