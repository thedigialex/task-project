<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(isset($subtask))
                {{ __('Edit Subtask: ') . $subtask->name }}
            @else
                {{ __('New Subtask for ') . $taskName, $taskId}}
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ isset($subtask) ? route('subtasks.update', ['subtaskId' => $subtask->id]) : route('subtasks.store', ['taskId' => $taskId]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($subtask))
                            @method('PUT')
                        @endif
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($subtask) ? $subtask->name : '' }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Description:</label>
                            <input type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($subtask) ? $subtask->description : '' }}" />
                        </div>

                        <div class="mb-4">
                            <label for="is_complete" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Is Complete?</label>
                            <select name="is_complete" id="is_complete" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="0" {{ isset($subtask) && !$subtask->is_complete ? 'selected' : '' }}>No</option>
                                <option value="1" {{ isset($subtask) && $subtask->is_complete ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ring">
                                {{ isset($subtask) ? __('Save subtask') : __('Create subtask') }}
                            </button>
                        </div>
                    </form>
                    @if(isset($subtask))
                        <form method="POST" action="{{ route('subtasks.destroy', ['subtaskId' => $subtask->id]) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">{{ __('Delete subtask') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
