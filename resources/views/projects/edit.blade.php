<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('projects.update', ['id' => $project->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}:</label>
                        <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $project->name }}" required />

                        {{-- Add more form fields as needed --}}

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Update Project') }}
                        </button>
                    </form>

                    <p>{{ __('Company') }}: {{ $project->company->name }}</p>

                    <h2>{{ __('Tasks') }}</h2>
                    <ul>
                        @foreach($project->tasks as $task)
                            <li>
                                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->description }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
