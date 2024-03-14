<x-app-layout>
    @if(isset($task))
    <x-header :headerTitle="'Edit Task'"></x-header>
    @else
    <x-header :headerTitle="'Create Task'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ isset($task) ? route('tasks.update', ['taskId' => $task->id]) : route('tasks.store', ['phaseId' => $phaseId]) }}" method="post" enctype="multipart/form-data" class="w-full max-w-md mx-auto">
                    @csrf
                    @if(isset($task))
                    @method('PUT')
                    @endif
                    <div class="mb-4">
                        <label for="title" class="block text-cyan-100 text-sm font-bold mb-2">Title:</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($task) ? $task->title : '' }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-cyan-100 text-sm font-bold mb-2">Description:</label>
                        <input type="text" name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($task) ? $task->description : '' }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="user_id" class="block text-cyan-100 text-sm font-bold mb-2">Assign to Staff:</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50">
                            <option value="">Select Staff</option>
                            @foreach ($staffUsers as $user)
                            <option value="{{ $user->id }}" {{ (isset($task) && $task->user_id == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-4">
                        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                            <label for="target_date" class="block text-cyan-100 text-sm font-bold mb-2">Target Date:</label>
                            <input type="date" name="target_date" id="target_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($task) ? $task->target_date : '' }}" required />
                        </div>
                        <div class="w-full md:w-1/2 px-2">
                            <label for="hours_required" class="block text-cyan-100 text-sm font-bold mb-2">Hours Required:</label>
                            <input type="number" name="hours_required" id="hours_required" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($task) ? $task->hours_required : '' }}" required />
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <div class="mb-4 flex-1">
                            <label for="status" class="block text-cyan-100 text-sm font-bold mb-2">Status:</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required>
                                <option value="new" {{ isset($task) && $task->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="info" {{ isset($task) && $task->status === 'info' ? 'selected' : '' }}>Require More Info</option>
                                <option value="progress" {{ isset($task) && $task->status === 'progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="testing" {{ isset($task) && $task->status === 'testing' ? 'selected' : '' }}>Internal Testing</option>
                                <option value="approval" {{ isset($task) && $task->status === 'approval' ? 'selected' : '' }}>Require Approval</option>
                                <option value="complete" {{ isset($task) && $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <div class="mb-4 flex-1">
                            <label for="priority" class="block text-cyan-100 text-sm font-bold mb-2">Priority:</label>
                            <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required>
                                <option value="low" {{ isset($task) && $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ isset($task) && $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ isset($task) && $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ isset($task) && $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>

                        <div class="mb-4 flex-1">
                            <label for="technological_level" class="block text-cyan-100 text-sm font-bold mb-2">Technological Level:</label>
                            <select name="technological_level" id="technological_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required>
                                <option value="low" {{ isset($task) && $task->technological_level === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ isset($task) && $task->technological_level === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ isset($task) && $task->technological_level === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                    </div>
                    <div class="mb-4 flex-1">
                        <label for="image" class="block text-cyan-100 text-sm font-bold mb-2">Image:</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" accept="image/*" />
                    </div>

                    <div class="flex justify-center">
                        <x-button type="submit">
                            {{ isset($task) ? __('Save Task') : __('Create Task') }}
                        </x-button>
                    </div>
                </form>
                @if(isset($task))
                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
                    {{ __('Delete Task') }}
                </button>
                <form id="delete-form" action="{{ route('tasks.destroy', ['taskId' => $task->id]) }}" method="post" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this task?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>