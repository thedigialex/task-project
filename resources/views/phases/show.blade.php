<x-app-layout>
    <div x-data="{ taskButtonClicked: true }">
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
                    <div class="p-6 dark:text-gray-100 flex justify-between items-center">
                        <h2 class="text-xl font-bold">{{ __('Tasks') }}</h2>
                        {{-- Create Task --}}
                        <a href="{{ route('tasks.create', ['phaseId' => $phase->id]) }}" class="dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200">{{ __('Create New Task') }}</a>
                    </div>
                    <div x-data="{ tab: 'pending' }" class="p-6 flex flex-col ">
                        <div class="p-4 flex-row bg-gray-300 dark:bg-gray-700 space-x-4">
                            {{-- Set the text color based on if the tab is active and if they prefer dark mode --}}
                            <button @click="tab = 'pending'" :class="{ 'bg-blue-500 text-white': tab === 'pending', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== 'pending' }" class="px-4 rounded">New</button>
                            <button @click="tab = 'in_progress'" :class="{ 'bg-blue-500 text-white': tab === 'in_progress', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== 'in_progress' }" class="px-4 rounded">In Progress</button>
                            <button @click="tab = 'completed'" :class="{ 'bg-blue-500 text-white': tab === 'completed', 'dark:text-gray-400 dark:hover:text-gray-300 hover:text-white transition': tab !== 'completed'}" class="px-4 rounded">Completed</button>
                        </div>
                        <table class="min-w-full border rounded-md">
                            <thead>
                                <tr>
                                    <th class="border p-2 w-1/3 dark:text-gray-400">{{ __('Title') }}</th>
                                    <th class="border p-2 w-1/3 dark:text-gray-400">{{ __('Priority') }}</th>
                                    <th class="border p-2 w-1/3 dark:text-gray-400">{{ __('Hours Required') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sortedTasks as $task)
                                <tr  x-show="tab === 'pending' && '{{ $task->status }}' === 'todo' || tab === 'completed' && '{{ $task->status }}' === 'completed' || tab === 'in_progress' && '{{ $task->status }}' === 'in_progress'"
                                     x-transition.duration.300ms
                                >
                                    <td class="border p-2 dark:text-gray-400">
                                        <a @click="$dispatch('task-info-click', { id:{{ $task->id }}, title:'{{ $task->title }}', description:'{{ $task->description }}', priority:'{{ $task->priority }}', completion_expected_date:'{{ $task->completion_expected_date }}', hours_required:'{{ $task->hours_required }}', technological_level:'{{ $task->technological_level }}', image_path:'{{ $task->image_path }}'})"
                                           class="task-info-link font-bold text-lg text-blue-500 hover:text-blue-700 hover:cursor-pointer transition-colors ease-in-out">
                                            {{ $task->title }}
                                        </a>

                                    </td>
                                    <td class="border p-2 dark:text-gray-400">{{ $task->priority }}</td>
                                    <td class="border p-2 dark:text-gray-400">{{ $task->hours_required }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <template x-if="taskButtonClicked">
            @include('tasks.show', ['tasks' => $tasks])
        </template>
    </div>
</x-app-layout>
