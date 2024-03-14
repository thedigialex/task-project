<x-app-layout>
    @if(isset($subtask))
    <x-header :headerTitle="'Edit Subtask'"></x-header>
    @else
    <x-header :headerTitle="'Create Subtask'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ isset($subtask) ? route('subtasks.update', ['subtaskId' => $subtask->id]) : route('subtasks.store', ['taskId' => $taskId]) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-md mx-auto">
                    @csrf
                    @if(isset($subtask))
                    @method('PUT')
                    @endif
                    <div class="mb-4">
                        <label for="name" class="block text-cyan-100 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($subtask) ? $subtask->name : '' }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-cyan-100 text-sm font-bold mb-2">Description:</label>
                        <input type="text" name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($subtask) ? $subtask->description : '' }}" />
                    </div>

                    <div class="mb-4">
                        <label for="is_complete" class="block text-cyan-100 text-sm font-bold mb-2">Is Complete?</label>
                        <select name="is_complete" id="is_complete" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50">
                            <option value="0" {{ isset($subtask) && !$subtask->is_complete ? 'selected' : '' }}>No</option>
                            <option value="1" {{ isset($subtask) && $subtask->is_complete ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div class="flex justify-center">
                        <x-button type="submit">
                            {{ isset($subtask) ? __('Save subtask') : __('Create subtask') }}
                        </x-button>
                    </div>

                </form>
                @if(isset($subtask))
                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
                    {{ __('Delete Project') }}
                </button>
                <form id="delete-form" action="{{ route('subtasks.destroy', ['subtaskId' => $subtask->id]) }}" method="post" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this subtask?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>