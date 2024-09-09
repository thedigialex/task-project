<x-app-layout>
    @if(isset($bug))
    <x-header :headerTitle="'Edit Bug'"></x-header>
    @else
    <x-header :headerTitle="'Create Bug'"></x-header>
    @endif
    <x-container :title="'User'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form method="POST" action="{{ isset($bug) ? route('bugs.update', ['bugId' => $bug->id]) : route('bugs.store', ['projectId' => $project->id]) }}" class="w-full max-w-md mx-auto bg-body p-4 rounded-md bg-body">
                @csrf
                @if(isset($bug))
                @method('PUT')
                @endif

                <!-- Bug Title -->
                <div class="mb-4">
                    <x-input-label for="title" :value="__('Bug Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($bug) ? $bug->title : '')" required />
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description', isset($bug) ? $bug->description : '') }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="block mt-1 w-full rounded-md border-border shadow-sm" required>
                        <option value="reported" {{ (isset($bug) && $bug->status == 'reported') ? 'selected' : '' }}>Reported</option>
                        <option value="researching" {{ (isset($bug) && $bug->status == 'researching') ? 'selected' : '' }}>Researching</option>
                        <option value="testing" {{ (isset($bug) && $bug->status == 'testing') ? 'selected' : '' }}>Testing</option>
                        <option value="patched" {{ (isset($bug) && $bug->status == 'patched') ? 'selected' : '' }}>Patched</option>
                    </select>
                </div>
                <br>
                <!-- Submit Button -->
                <div class="flex justify-center">
                    <x-primary-button>
                        {{ isset($bug) ? __('Update Bug') : __('Create Bug') }}
                    </x-primary-button>
                </div>
            </form>

            @if(isset($bug))
            <!-- Delete Button -->
            <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
                {{ __('Delete Bug') }}
            </button>
            <form id="delete-form" action="{{ route('bugs.destroy', ['bugId' => $bug->id]) }}" method="post" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            @endif

        </div>
    </x-container>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this bug?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>