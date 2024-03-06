<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline">
                    {{ $phase->name }}
                    <a href="{{ route('phases.edit', ['phaseId' => $phase->id]) }}" class="inline text-blue-500 hover:underline">
                        <i class="fas fa-pencil-alt ml-2"></i>
                    </a>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    Targeted Date: {{ $phase->targeted_end_date }}
                </p>
            </div>
            <div>
                <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $completedTaskTime }} / {{ $remainingTaskTime }} Hours
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    Completed / Remaining Task Time
                </p>
            </div>
        </div>
    </x-slot>
    {{-- Task or Calendar selection --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ activeTab: 'table' }">
        <div class="flex flex-row p-4 justify-evenly dark:text-gray-400 bg-gray-200 dark:bg-gray-700 space-x-4">
            <button @click="activeTab = 'table'" :class="{ 'bg-blue-500 text-white': activeTab === 'table' }" class="px-4 py-2 rounded">Task Table</button>
            <button @click="activeTab = 'calendar'" :class="{ 'bg-blue-500 text-white': activeTab === 'calendar' }" class="px-4 py-2 rounded">Calendar</button>
        </div>
        {{-- Tasks Table --}}
        <div x-show="activeTab === 'table'">
            <div class="py-12" x-data="{ taskButtonClicked: true }" @task-info-click.window="taskButtonClicked = true">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 dark:text-gray-100 flex justify-between items-center">
                            <h2 class="text-xl font-bold">{{ __('Tasks') }}</h2>
                            <x-button>
                                <a href="{{ route('tasks.create', ['phaseId' => $phase->id]) }}">{{ __('New Task') }}</a>
                            </x-button>
                            {{-- Create Task --}}
                        </div>
                        <div x-data="{ tab: 'pending' }" class="p-6 flex flex-col ">
                            <div class="p-2 flex-row bg-gray-400 dark:bg-gray-700 space-x-4">
                                {{-- Set the text color based on if the tab is active and if they prefer dark mode --}}
                                <button @click="tab = 'pending'" :class="{ 'bg-blue-500 text-white': tab === 'pending', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== 'pending' }" class="px-2 rounded">New</button>
                                <button @click="tab = 'in_progress'" :class="{ 'bg-blue-500 text-white': tab === 'in_progress', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== 'in_progress' }" class="px-2 rounded">In Progress</button>
                                <button @click="tab = 'completed'" :class="{ 'bg-blue-500 text-white': tab === 'completed', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== 'completed'}" class="px-2 rounded">Completed</button>
                            </div>
                            <table class="min-w-full border rounded-md">
                                <thead>
                                    <tr>
                                        <th class="border p-2 w-1/4 dark:text-gray-400"></th>
                                        <th class="border p-2 w-1/4 dark:text-gray-400">{{ __('Assigned To') }}</th>
                                        <th class="border p-2 w-1/4 dark:text-gray-400">{{ __('Due Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sortedTasks as $task)
                                    <tr x-show="tab === 'pending' && '{{ $task->status }}' === 'todo' || tab === 'completed' && '{{ $task->status }}' === 'completed' || tab === 'in_progress' && '{{ $task->status }}' === 'in_progress'" x-transition.duration.300ms>
                                        <td class="border p-2 dark:text-gray-400">
                                            <button onclick="toggleSubTasks(this)">▼</button>
                                            <a @click="$dispatch('task-info-click', { id:{{ $task->id }}, title:'{{ $task->title }}', description:'{{ $task->description }}', priority:'{{ $task->priority }}', completion_expected_date:'{{ $task->completion_expected_date }}', hours_required:'{{ $task->hours_required }}', technological_level:'{{ $task->technological_level }}', image_path:'{{ $task->image_path }}'})" class="task-info-link font-bold text-lg text-blue-500 hover:text-blue-700 hover:cursor-pointer transition-colors ease-in-out">
                                                {{ $task->title }}
                                            </a>
                                        </td>
                                        <td class="border p-2 dark:text-gray-400">{{ $task->user->name ?? 'Unassigned' }}</td>
                                        <td class="border p-2 dark:text-gray-400">{{ $task->completion_expected_date }}</td>
                                    </tr>
                                    <tr class="sub-task-row hidden">
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
                    </div>
                </div>
                <template x-if="taskButtonClicked">
                    @include('tasks.show', ['tasks' => $sortedTasks])
                </template>
            </div>
        </div>
        <div x-show="activeTab === 'calendar'">
            <div id="calendar"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var sortedTasks = JSON.parse('<?php echo json_encode($sortedTasks->toArray()); ?>');
            var targetedEndDate = JSON.parse('<?php echo json_encode($phase->targeted_end_date); ?>');
            var events = sortedTasks.map(task => ({
                title: task.title,
                start: task.completion_expected_date,
            }));
            events.push({
                title: 'Targeted End Date',
                start: targetedEndDate,
                color: '#ff0000',
            });
            $('#calendar').fullCalendar({
                events: events,
            });
        });
        $(document).ready(function() {
            $('.toggle-status').on('click', function() {
                var button = $(this);
                var subtaskId = button.data('subtask-id');
                var isCompleted = button.data('subtask-status');

                $.ajax({
                    url: '/subtasks/' + subtaskId + '/toggle',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'PATCH',
                        is_completed: !isCompleted
                    },
                    success: function(response) {
                        if (isCompleted) {
                            button.removeClass('bg-green-500 hover:bg-green-600').addClass('bg-red-500 hover:bg-red-600');
                        } else {
                            button.removeClass('bg-red-500 hover:bg-red-600').addClass('bg-green-500 hover:bg-green-600');
                        }
                        button.data('subtask-status', !isCompleted);
                    }
                });
            });
        });
    </script>
</x-app-layout>