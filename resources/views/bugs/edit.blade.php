<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(isset($bug))
            {{ __('Edit Bug') }}
            @else
            {{ __('Create Bug') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($bug) ? route('bugs.update', ['bugId' => $bug->id]) : route('bugs.store', ['projectId' => $project->id]) }}">
                    @csrf
                    @if(isset($bug))
                    @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Bug Title:</label>
                        <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full" required value="{{ isset($bug) ? $bug->title : old('title') }}" />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" required>{{ isset($bug) ? $bug->description : old('description') }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <select name="status" id="status" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                            <option value="reported" {{ (isset($bug) && $bug->status == 'reported') ? 'selected' : '' }}>Reported</option>
                            <option value="researching" {{ (isset($bug) && $bug->status == 'researching') ? 'selected' : '' }}>Researching</option>
                            <option value="testing" {{ (isset($bug) && $bug->status == 'testing') ? 'selected' : '' }}>Testing</option>
                            <option value="patched" {{ (isset($bug) && $bug->status == 'patched') ? 'selected' : '' }}>Patched</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                            @if(isset($bug))
                            {{ __('Update Bug') }}
                            @else
                            {{ __('Create Bug') }}
                            @endif
                        </button>
                    </div>
                </form>
                @if(isset($bug))
                <form method="POST" action="{{ route('bugs.destroy', ['bugId' => $bug->id]) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">{{ __('Delete Bug') }}</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>