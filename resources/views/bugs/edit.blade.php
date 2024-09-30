<x-app-layout>
    @if(isset($bug))
    <x-header :headerTitle="'Edit Bug'"></x-header>
    @else
    <x-header :headerTitle="'Create Bug'"></x-header>
    @endif
    <x-container :title="'Bug'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form method="POST" action="{{ isset($bug) ? route('bugs.update') : route('bugs.store', ['projectId' => $project->id]) }}" class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md">
                @if(isset($bug))
                <input type="hidden" name="bug_id" value="{{ $bug->id }}">
                @method('PUT')
                @else
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                @endif
                <!-- Bug Title -->
                <div class="mb-4">
                    <x-input-label for="title" :value="__('Bug Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($bug) ? $bug->title : '')" required />
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" class="mt-1 bg-body w-full rounded-md shadow-sm focus:ring-2 focus:ring-accent focus:border-accent" name="description" rows="3" required>{{ old('description', isset($bug) ? $bug->description : '') }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="block mt-1 w-full bg-body rounded-md border-border shadow-sm focus:ring-2 focus:ring-accent focus:border-accent" required>
                        <option value="reported" {{ (isset($bug) && $bug->status == 'reported') ? 'selected' : '' }}>Reported</option>
                        <option value="repairing" {{ (isset($bug) && $bug->status == 'repairing') ? 'selected' : '' }}>Repairing</option>
                        <option value="resolved" {{ (isset($bug) && $bug->status == 'resolved') ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>

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