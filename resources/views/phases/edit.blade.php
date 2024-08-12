<x-app-layout>
    @if(isset($phase))
        <x-header :headerTitle="'Edit Phase'"></x-header>
    @else
        <x-header :headerTitle="'Create Phase'"></x-header>
    @endif

    <x-container :title="'Phase'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form action="{{ isset($phase) ? route('phases.update', ['phaseId' => $phase->id]) : route('phases.store', ['projectId' => $project->id]) }}" method="post" class="w-full max-w-md mx-auto">
                @csrf
                @if(isset($phase))
                    @method('PUT')
                @endif

                <!-- Phase Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Phase Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($phase) ? $phase->name : '')" required />
                </div>

                <!-- Goal -->
                <div class="mb-4">
                    <x-input-label for="goal" :value="__('Goal')" />
                    <textarea name="goal" id="goal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm " required>{{ old('goal', isset($phase) ? $phase->goal : '') }}</textarea>
                </div>

                <!-- Target Date -->
                <div class="mb-4">
                    <x-input-label for="target_date" :value="__('Target Date')" />
                    <x-text-input id="target_date" class="block mt-1 w-full" type="date" name="target_date" :value="old('target_date', isset($phase) ? $phase->target_date : '')" required />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <x-primary-button>
                        {{ isset($phase) ? __('Update Phase') : __('Create Phase') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Delete Phase Button -->
            @if(isset($phase))
            <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
                {{ __('Delete Phase') }}
            </button>
            <form id="delete-form" action="{{ route('phases.destroy', ['phaseId' => $phase->id]) }}" method="post" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            @endif
        </div>
    </x-container>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this phase?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>
