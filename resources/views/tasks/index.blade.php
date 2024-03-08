<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline">
                    {{ __('Assigned Tasks') }}
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ taskButtonClicked: true }" @task-info-click.window="taskButtonClicked = true">
        <x-round-div>
            <div class="dark:text-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold">{{ __('Tasks') }}</h2>
            </div>
            <div x-data="{ tab: 'new' }" class="p-6 flex flex-col ">
                <div class="p-2 flex-row bg-gray-400 dark:bg-gray-700 space-x-4">
                    @foreach($statuses as $status)
                    <button @click="tab = '{{ $status }}'" :class="{ 'bg-blue-500 text-white': tab === '{{ $status }}', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== '{{ $status }}' }" class="px-2 rounded">
                        {{ ucfirst($status) }}
                    </button>
                    @endforeach
                </div>
                <table class="min-w-full border rounded-md">
                    <thead>
                        <tr>
                            <th class="border p-2 w-1/4 dark:text-gray-400"></th>
                            <th class="border p-2 w-1/4 dark:text-gray-400">{{ __('Assigned To') }}</th>
                            <th class="border p-2 w-1/4 dark:text-gray-400">{{ __('Project') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sortedTasks as $task)
                        <tr x-show="tab === '{{ $task->status }}'" x-transition.duration.300ms>
                            <td class="border p-2 dark:text-gray-400">
                                <button onclick="toggleSubTasks(this)">▼</button>
                                <a >
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td class="border p-2 dark:text-gray-400">{{ $task->user->name ?? 'Unassigned' }}</td>
                            <td class="border p-2 dark:text-gray-400">{{ $task->phase->project->name }}</td>
                        </tr>
                        <tr class="hidden">
                            <td colspan="4" class="border p-2 dark:text-gray-400">
                                <table class="min-w-full">
                                    <tbody>
                                        @foreach($task->subTasks as $subTask)
                                        <tr>
                                            <td class="p-2 flex items-center">
                                                <button type="button" class="toggle-status py-3 px-6 rounded transition-colors duration-100 {{ $subTask->is_complete ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}" data-subtask-id="{{ $subTask->id }}" data-subtask-status="{{ $subTask->is_complete }}">
                                                </button>
                                                <a href="{{ route('subtasks.edit', ['subtaskId' => $subTask->id]) }}" class="ps-8 inline text-blue-500 hover:underline">
                                                    {{ $subTask->name }}
                                                </a>: {{ $subTask->description }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('subtasks.create', ['taskId' => $task->id]) }}" class="block mx-auto py-2 px-4 dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 rounded transition ease-in-out duration-200">{{ __('Create New SubTask') }}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    function toggleSubTasks(button) {
                        var subTaskRow = button.closest('tr').nextElementSibling;
                        subTaskRow.classList.toggle('hidden');
                        button.textContent = subTaskRow.classList.contains('hidden') ? '▼' : '▲';
                    }
                </script>
            </div>
        </x-round-div>

    </div>
    </div>


</x-app-layout>