<x-app-layout>
    @if(isset($subtask))
        <x-header :headerTitle="'Edit Subtask'"></x-header>
    @else
        <x-header :headerTitle="'Create Subtask'"></x-header>
    @endif

    <x-container :title="'Subtask'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form action="{{ isset($subtask) ? route('subtasks.update', ['subtaskId' => $subtask->id]) : route('subtasks.store', ['taskId' => $taskId]) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-md mx-auto bg-body p-4 rounded-md bg-body">
                @csrf
                @if(isset($subtask))
                    @method('PUT')
                @endif

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($subtask) ? $subtask->name : '')" required />
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', isset($subtask) ? $subtask->description : '')" />
                </div>

                <!-- Is Complete -->
                <div class="mb-4">
                    <x-input-label for="is_complete" :value="__('Is Complete?')" />
                    <select name="is_complete" id="is_complete" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm ">
                        <option value="0" {{ isset($subtask) && !$subtask->is_complete ? 'selected' : '' }}>No</option>
                        <option value="1" {{ isset($subtask) && $subtask->is_complete ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <x-primary-button>
                        {{ isset($subtask) ? __('Save Subtask') : __('Create Subtask') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Delete Subtask Button -->
            @if(isset($subtask))
            <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
                {{ __('Delete Subtask') }}
            </button>
            <form id="delete-form" action="{{ route('subtasks.destroy', ['subtaskId' => $subtask->id]) }}" method="post" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            @endif
        </div>
    </x-container>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this subtask?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>
