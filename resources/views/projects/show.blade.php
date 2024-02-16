<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $project->name }}
            </h2>
            <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="block text-blue-500 hover:underline">{{ __('+') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <h2>{{ __('Tasks') }}</h2>
                    {{-- Create Task --}}
                    <a href="{{ route('tasks.create', ['projectId' => $project->id]) }}" class="text-blue-500 hover:underline">{{ __('Create New Task') }}</a>
                </div>
                <div x-data="{ tab: 'pending' }">
                    <div class="flex p-4 bg-gray-200 space-x-4">
                        <button @click="tab = 'pending'" :class="{ 'bg-blue-500': tab === 'pending' }" class="text-white px-4 py-2 rounded">New</button>
                        <button @click="tab = 'in_progress'" :class="{ 'bg-blue-500': tab === 'in_progress' }" class="text-white px-4 py-2 rounded">In Progress</button>
                        <button @click="tab = 'completed'" :class="{ 'bg-blue-500': tab === 'completed' }" class="text-white px-4 py-2 rounded">Completed</button>
                    </div>
                    <table class="min-w-full border rounded-md">
                        <thead>
                            <tr>
                                <th class="border p-2 w-1/3">{{ __('Title') }}</th>
                                <th class="border p-2 w-1/3">{{ __('Priority') }}</th>
                                <th class="border p-2 w-1/3">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sortedTasks = $project->tasks->sortBy(function ($task) {
                            return array_search($task->priority, ['urgent', 'high', 'medium', 'low']);
                            });
                            @endphp

                            @foreach($sortedTasks as $task)
                            <tr x-show="tab === 'pending' && '{{ $task->status }}' === 'todo' || tab === 'completed' && '{{ $task->status }}' === 'completed' || tab === 'in_progress' && '{{ $task->status }}' === 'in_progress'">
                                <td class="border p-2">
                                    <a href="{{ route('tasks.edit', ['id' => $task->id]) }}" class="edit-link">{{ $task->title }}</a>
                                </td>
                                <td class="border p-2">{{ $task->priority }}</td>
                                <td class="border p-2">{{ $task->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>