<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>{{ __('Company') }}: {{ $project->company->name }}</p>

                    <h2>{{ __('Tasks') }}</h2>
                    <ul>
                        @foreach($project->tasks as $task)
                            <li>
                                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->description }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="text-blue-500 hover:underline">{{ __('Edit Project') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
