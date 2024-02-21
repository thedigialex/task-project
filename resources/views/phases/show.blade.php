<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $phase->name }}
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <h2>{{ __('Tasks') }}</h2>
                    {{-- Create Task --}}
                    <a href="{{ route('tasks.create', ['phaseId' => $phase->id]) }}" class="text-blue-500 hover:underline">{{ __('Create New Task') }}</a>
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
                                <th class="border p-2 w-1/3">{{ __('Hours Required') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sortedTasks = $phase->tasks->sortBy(function ($task) {
                            return array_search($task->priority, ['urgent', 'high', 'medium', 'low']);
                            });
                            @endphp

                            @foreach($sortedTasks as $task)
                            <tr x-show="tab === 'pending' && '{{ $task->status }}' === 'todo' || tab === 'completed' && '{{ $task->status }}' === 'completed' || tab === 'in_progress' && '{{ $task->status }}' === 'in_progress'">
                                <td class="border p-2">
                                    <a href="#" class="task-info-link edit-link" data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}" data-task-description="{{ $task->description }}" data-task-priority="{{ $task->priority }}" data-task-completion-date="{{ $task->completion_expected_date }}" data-task-hours="{{ $task->hours_required }}" data-task-tech-level="{{ $task->technological_level }}" data-task-image="{{ $task->image_path }}">
                                        {{ $task->title }}
                                    </a>

                                </td>
                                <td class="border p-2">{{ $task->priority }}</td>
                                <td class="border p-2">{{ $task->hours_required }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>{{ __('Task') }}</h2>
            <p id="taskInfoContent"></p>
        </div>
    </div>
    <script>
        var modal = document.getElementById('taskModal');
        var closeButton = document.querySelector('.close');
        var taskInfoLinks = document.getElementsByClassName('task-info-link');

        for (var i = 0; i < taskInfoLinks.length; i++) {
            taskInfoLinks[i].addEventListener('click', function(event) {
                event.preventDefault();
                var taskId = this.getAttribute('data-task-id');
                var taskTitle = this.getAttribute('data-task-title');
                var taskDescription = this.getAttribute('data-task-description');
                var taskPriority = this.getAttribute('data-task-priority');
                var taskCompletionDate = this.getAttribute('data-task-completion-date');
                var taskHours = this.getAttribute('data-task-hours');
                var taskTechLevel = this.getAttribute('data-task-tech-level');
                var taskImage = this.getAttribute('data-task-image');
                displayTaskInfo(taskId, taskTitle, taskDescription, taskPriority, taskCompletionDate, taskHours, taskTechLevel, taskImage);
                modal.style.display = 'block';
            });
        }

        closeButton.onclick = function() {
            modal.style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };

        function displayTaskInfo(taskId, taskTitle, taskDescription, taskPriority, taskCompletionDate, taskHours, taskTechLevel, taskImage) {
            var taskInfoContent = document.getElementById('taskInfoContent');
            var headerSection =
                '<div>' +
                '<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">' + taskTitle + '</h2>' +
                '<p class="text-sm text-gray-500 dark:text-gray-300"> Expected Completion Date: ' + taskCompletionDate + '</p>' +
                '</div>';
            var detailsSection =
                '<div>' +
                '<strong class="ml-4">Hours:</strong> ' + taskHours +
                '<strong class="ml-4">Priority:</strong> ' + taskPriority +
                '<strong class="ml-4">Tech Level:</strong> ' + taskTechLevel +
                '</div>';
            var descriptionSection =
                '<div>' +
                '<strong>Description:</strong> ' + taskDescription +
                '</div>' + '<br>';

            var imageSection = '';
            if (taskImage) {
                imageSection = '<div>' +
                    '<img src="' + '/storage/' + taskImage + '" alt="Task Image" class="max-w-full h-auto mb-4">' +
                    '</div>';
            }

            taskInfoContent.innerHTML = headerSection + detailsSection + descriptionSection + imageSection;

            var editLink = document.createElement('a');
            editLink.href = "{{ route('tasks.edit', ['taskId' => 'TASK_ID']) }}".replace('TASK_ID', taskId);
            editLink.classList.add('edit-link');
            editLink.innerText = 'Edit';
            taskInfoContent.appendChild(editLink);
        }
    </script>
</x-app-layout>