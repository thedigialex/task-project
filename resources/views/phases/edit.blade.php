<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(isset($phase))
            {{ __('Edit Phase') }}
            @else
            {{ __('Create New Phase') }}
            @endif
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ isset($phase) ? route('phases.update', ['phaseId' => $phase->id]) : route('phases.store', ['projectId' => $project->id]) }}" method="post">
                @csrf
                @if(isset($phase))
                @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Phase Name</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-md w-full" value="{{ old('name', isset($phase) ? $phase->name : '') }}" required>
                </div>

                <div class="mb-4">
                    <label for="goal" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Goal</label>
                    <textarea name="goal" id="goal" class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-md w-full" required>{{ old('goal', isset($phase) ? $phase->goal : '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="targeted_end_date" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Targeted End Date</label>
                    <input type="date" name="targeted_end_date" id="targeted_end_date" class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-md w-full" value="{{ old('targeted_end_date', isset($phase) ? $phase->targeted_end_date : '') }}" required>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    @if(isset($phase))
                    {{ __('Update Phase') }}
                    @else
                    {{ __('Create Phase') }}
                    @endif
                </button>
        </div>
        </form>

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
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this phase?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>