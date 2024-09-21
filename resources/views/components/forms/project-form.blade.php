<x-container :title="'Project'">
    <div class="flex flex-wrap gap-5 justify-center my-8 ">
        <form method="POST" action="{{ isset($project) ? route('projects.update') : route('projects.store') }}" class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md">
            @csrf
            @if(isset($project))
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            @method('PUT')
            @endif

            <!-- Target Date -->
            <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 mb-4 md:mb-0 md:pr-4">
                    <x-input-label for="name" :value="__('Project Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($project) ? $project->name : '')" required />
                </div>
                <div class="w-full md:w-1/2 mb-4 md:mb-0 md:pl-4">
                    <x-input-label for="target_date" :value="__('Target Date')" />
                    <x-text-input id="target_date" class="block mt-1 w-full" type="date" name="target_date" :value="old('target_date', isset($project) ? $project->target_date : '')" />
                </div>
            </div>

            <!-- Description -->
            <div class="my-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea name="description" id="description" class="mt-1 bg-body w-full rounded-md shadow-sm focus:ring-2 focus:ring-accent focus:border-accent" rows="3">{{ isset($project) ? $project->description : old('description') }}</textarea>
            </div>

            <!-- Main Contact -->
            @isset($users)
            <div class="mb-4">
                <x-input-label for="main_contact" :value="__('Main Contact')" />
                <select name="main_contact" id="main_contact" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">N/A</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (isset($project) && $project->main_contact == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endisset

            <!-- Company -->
            @isset($companies)
            <div class="mb-4">
                <x-input-label for="company" :value="__('Company')" />
                <select name="company" id="company" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">N/A</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            @endisset

            <!-- Submit Button -->
            <div class="flex justify-center">
                <x-primary-button>
                    {{ isset($project) ? __('Update Project') : __('Create Project') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Delete Project Button -->
        @if(isset($project))
        <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="confirmDelete()">
            {{ __('Delete Project') }}
        </button>
        <form id="delete-form" action="{{ route('projects.destroy', ['projectId' => $project->id]) }}" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        @endif
    </div>
</x-container>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this project?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>