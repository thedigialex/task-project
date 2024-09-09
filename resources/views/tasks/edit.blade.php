<x-app-layout>
    @if(isset($task))
        <x-header :headerTitle="'Edit Task'"></x-header>
    @else
        <x-header :headerTitle="'Create Task'"></x-header>
    @endif

    <x-container :title="'Task'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form action="{{ isset($task) ? route('tasks.update', ['taskId' => $task->id]) : route('tasks.store', ['phaseId' => $phaseId]) }}" method="post" enctype="multipart/form-data" class="w-full max-w-md mx-auto bg-body p-4 rounded-md bg-body">
                @csrf
                @if(isset($task))
                    @method('PUT')
                @endif

                <!-- Title -->
                <div class="mb-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($task) ? $task->title : '')" required />
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', isset($task) ? $task->description : '')" required />
                </div>

                <!-- Target Date and Hours Required -->
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                        <x-input-label for="target_date" :value="__('Target Date')" />
                        <x-text-input id="target_date" class="block mt-1 w-full" type="date" name="target_date" :value="old('target_date', isset($task) ? $task->target_date : '')" required />
                    </div>

                    <div class="w-full md:w-1/2 px-2">
                        <x-input-label for="hours_required" :value="__('Hours Required')" />
                        <x-text-input id="hours_required" class="block mt-1 w-full" type="number" name="hours_required" :value="old('hours_required', isset($task) ? $task->hours_required : '')" required />
                    </div>
                </div>

                <!-- Status, Priority, and Staff -->
                <div class="flex space-x-4">
                    <div class="mb-4 flex-1">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm " required>
                            <option value="new" {{ isset($task) && $task->status === 'new' ? 'selected' : '' }}>New</option>
                            <option value="progress" {{ isset($task) && $task->status === 'progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="testing" {{ isset($task) && $task->status === 'testing' ? 'selected' : '' }}>Testing</option>
                            <option value="complete" {{ isset($task) && $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="mb-4 flex-1">
                        <x-input-label for="priority" :value="__('Priority')" />
                        <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm " required>
                            <option value="low" {{ isset($task) && $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ isset($task) && $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ isset($task) && $task->priority == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    <div class="mb-4 flex-1">
                    <x-input-label for="user_id" :value="__('Assign to Staff')" />
                    <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm ">
                        <option value="">Select</option>
                        @foreach ($staffUsers as $user)
                            <option value="{{ $user->id }}" {{ (isset($task) && $task->user_id == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <x-primary-button>
                        {{ isset($task) ? __('Save Task') : __('Create Task') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Delete Task Button -->
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
    </x-container>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this task?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>
