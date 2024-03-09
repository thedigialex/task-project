<x-app-layout>
    <x-header :headerTitle="$phase->name" :linkUrl="route('phases.edit', ['phaseId' => $phase->id])" :subTitle="'Targeted Date: ' . $phase->targeted_end_date" :completedTaskTime="$completedTaskTime" :remainingTaskTime="$remainingTaskTime">
    </x-header>
    {{-- Task or Calendar selection --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ activeTab: 'table' }">
        <div class="flex flex-row p-4 justify-evenly dark:text-gray-400 bg-gray-200 dark:bg-gray-700 space-x-4">
            <button @click="activeTab = 'table'" :class="{ 'bg-blue-500 text-white': activeTab === 'table' }" class="px-4 py-2 rounded">Task Table</button>
            <button @click="activeTab = 'calendar'" :class="{ 'bg-blue-500 text-white': activeTab === 'calendar' }" class="px-4 py-2 rounded">Calendar</button>
        </div>
        <div x-show="activeTab === 'table'">
            <div class="py-12" x-data="{ taskButtonClicked: true }" @task-info-click.window="taskButtonClicked = true">
                <x-round-div>
                    <div class="dark:text-gray-100 flex justify-between items-center">
                        <h2 class="text-xl font-bold">{{ __('Tasks') }}</h2>
                        <x-button>
                            <a href="{{ route('tasks.create', ['phaseId' => $phase->id]) }}">{{ __('New Task') }}</a>
                        </x-button>
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
                                    <th class="border p-2 w-1/4 dark:text-gray-400">{{ __('Due Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sortedTasks as $task)
                                <tr x-show="tab === '{{ $task->status }}'" x-transition.duration.300ms>
                                    <td class="border p-2 dark:text-gray-400">
                                        <button onclick="toggleSubTasks(this)">▼</button>
                                        <a @click="$dispatch('task-info-click', { id:{{ $task->id }}, title:'{{ $task->title }}', description:'{{ $task->description }}', priority:'{{ $task->priority }}', completion_expected_date:'{{ $task->completion_expected_date }}', hours_required:'{{ $task->hours_required }}', technological_level:'{{ $task->technological_level }}', image_path:'{{ $task->image_path }}'})" class="task-info-link font-bold text-lg text-blue-500 hover:text-blue-700 hover:cursor-pointer transition-colors ease-in-out">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td class="border p-2 dark:text-gray-400">{{ $task->user->name ?? 'Unassigned' }}</td>
                                    <td class="border p-2 dark:text-gray-400">{{ $task->completion_expected_date }}</td>
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
                <template x-if="taskButtonClicked">
                    @include('tasks.show', ['tasks' => $sortedTasks])
                </template>
            </div>
        </div>
        <x-round-div x-show="activeTab === 'calendar'">
            <div id="calendar"></div>
        </x-round-div>
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