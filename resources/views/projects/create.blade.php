<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Project Name:</label>
                        <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                    </div>

                    {{-- Add more form fields as needed --}}

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
