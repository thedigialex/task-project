<x-app-layout>
    @if(isset($bug))
    <x-header :headerTitle="'Edit Bug'"></x-header>
    @else
    <x-header :headerTitle="'Create Bug'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($bug) ? route('bugs.update', ['bugId' => $bug->id]) : route('bugs.store', ['projectId' => $project->id]) }}" class="w-full max-w-md mx-auto">
                    @csrf
                    @if(isset($bug))
                    @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="title" class="block text-cyan-100 text-sm font-bold mb-2">Bug Title:</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required value="{{ isset($bug) ? $bug->title : old('title') }}" />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-cyan-100 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required>{{ isset($bug) ? $bug->description : old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-cyan-100 text-sm font-bold mb-2">Status:</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required>
                            <option value="reported" {{ (isset($bug) && $bug->status == 'reported') ? 'selected' : '' }}>Reported</option>
                            <option value="researching" {{ (isset($bug) && $bug->status == 'researching') ? 'selected' : '' }}>Researching</option>
                            <option value="testing" {{ (isset($bug) && $bug->status == 'testing') ? 'selected' : '' }}>Testing</option>
                            <option value="patched" {{ (isset($bug) && $bug->status == 'patched') ? 'selected' : '' }}>Patched</option>
                        </select>
                    </div>

                    <div class="flex justify-center">
                        <x-button type="submit">
                            @if(isset($bug))
                            {{ __('Update Bug') }}
                            @else
                            {{ __('Create Bug') }}
                            @endif
                        </x-button>
                    </div>
                </form>
                @if(isset($bug))
                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
                    {{ __('Delete Bug') }}
                </button>
                <form id="delete-form" action="{{ route('bugs.destroy', ['bugId' => $bug->id]) }}"  method="post" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
            </div>
        </div>
        <script>
            function confirmDelete() {
                if (confirm('Are you sure you want to delete this bug?')) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
    </div>>
</x-app-layout>
