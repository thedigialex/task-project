<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(isset($task))
            {{ __('Edit Task: ') . $task->title }}
            @else
            {{ __('Create New Task for Project') . $projectId }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ isset($task) ? route('tasks.update', ['projectId' => $task->project_id, 'id' => $task->id]) : route('tasks.save', ['projectId' => $projectId]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($task))
                        @method('PUT')
                        @endif
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($task) ? $task->title : '' }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <input type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($task) ? $task->description : '' }}" required />
                        </div>

                        <div class="flex space-x-4">

                            <div class="mb-4 flex-1">
                                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="todo" {{ isset($task) && $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                                    <option value="in_progress" {{ isset($task) && $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ isset($task) && $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <div class="mb-4 flex-1">
                                <label for="priority" class="block text-gray-700 text-sm font-bold mb-2">Priority:</label>
                                <select name="priority" id="priority" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="low" {{ isset($task) && $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ isset($task) && $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ isset($task) && $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ isset($task) && $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>

                            <div class="mb-4 flex-1">
                                <label for="technological_level" class="block text-gray-700 text-sm font-bold mb-2">Technological Level:</label>
                                <select name="technological_level" id="technological_level" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="low" {{ isset($task) && $task->technological_level === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ isset($task) && $task->technological_level === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ isset($task) && $task->technological_level === 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <div class="mb-4 flex-1">
                                <label for="flag" class="block text-gray-700 text-sm font-bold mb-2">Flag:</label>
                                <select name="flag" id="flag" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" {{ !isset($task) || $task->flag === null ? 'selected' : '' }}>Select Flag</option>
                                    <option value="waiting_for_client_approval" {{ isset($task) && $task->flag === 'waiting_for_client_approval' ? 'selected' : '' }}>Waiting for Client Approval</option>
                                    <option value="require_more_information" {{ isset($task) && $task->flag === 'require_more_information' ? 'selected' : '' }}>Require More Information</option>
                                    <option value="internal_testing" {{ isset($task) && $task->flag === 'internal_testing' ? 'selected' : '' }}>Internal Testing</option>
                                    <option value="on_hold" {{ isset($task) && $task->flag === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                </select>
                            </div>

                        </div>

                        <div class="mb-4">
                            <label for="completion_expected_date" class="block text-gray-700 text-sm font-bold mb-2">Completion Expected Date:</label>
                            <input type="date" name="completion_expected_date" id="completion_expected_date" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($task) ? $task->completion_expected_date : '' }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="hours_required" class="block text-gray-700 text-sm font-bold mb-2">Hours Required:</label>
                            <input type="number" name="hours_required" id="hours_required" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($task) ? $task->hours_required : '' }}" required />
                        </div>

                        <div class="mb-4 flex-1">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm mt-1 block w-full" accept="image/*" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($task) ? __('Save Task') : __('Create Task') }}
                            </button>
                        </div>
                    </form>
                    @if(isset($task))
                    <form method="POST" action="{{ route('tasks.destroy', ['id' => $task->id]) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">{{ __('Delete Task') }}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>