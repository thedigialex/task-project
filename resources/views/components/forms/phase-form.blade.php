<x-container :title="'Phase'">
    <div class="flex flex-wrap gap-5 justify-center my-8">
        <form method="POST" action="{{ isset($phase) ? route('phases.update') : route('phases.store') }}" class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md">
            @csrf
            @if(isset($phase))
            <input type="hidden" name="phase_id" value="{{ $phase->id }}">
            @method('PUT')
            @else
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            @endif

            <!-- Target Date -->
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 mb-4 md:mb-0 md:pr-4">
                    <x-input-label for="name" :value="__('Phase Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($phase) ? $phase->name : '')" required />
                </div>
                <div class="w-full md:w-1/2 mb-4 md:mb-0 md:pl-4">
                    <x-input-label for="target_date" :value="__('Target Date')" />
                    <x-text-input id="target_date" class="block mt-1 w-full" type="date" name="target_date" :value="old('target_date', isset($phase) ? $phase->target_date : '')" />
                </div>
            </div>

            <!-- Description -->
            <div class="my-4">
                <x-input-label for="goal" :value="__('Goal')" />
                <textarea name="goal" id="goal" class="mt-1 bg-body w-full rounded-md shadow-sm focus:ring-2 focus:ring-accent focus:border-accent" rows="3">{{ old('goal', isset($phase) ? $phase->goal : '')  }}</textarea>
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