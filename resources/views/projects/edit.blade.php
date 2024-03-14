<x-app-layout>
    @if(isset($project))
    <x-header :headerTitle="'Edit Project'"></x-header>
    @else
    <x-header :headerTitle="'Create Project'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($project) ? route('projects.update', ['projectId' => $project->id]) : route('projects.store') }}" class="w-full max-w-md mx-auto">
                    @csrf
                    @if(isset($project))
                    @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block  text-cyan-100 text-sm font-bold mb-2">{{ __('Project Name') }}:</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($project) ? $project->name : old('name') }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block  text-cyan-100 text-sm font-bold mb-2">{{ __('Description') }}:</label>
                        <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" rows="3">{{ isset($project) ? $project->description : old('description') }}</textarea>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-4">
                        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                            <label for="target_date" class="block  text-cyan-100 text-sm font-bold mb-2">{{ __('Target Date') }}:</label>
                            <input type="date" name="target_date" id="target_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($project) ? $project->target_date : old('target_date') }}" />
                        </div>

                        <div class="w-full md:w-1/2 px-2">
                            <label for="hours" class="block  text-cyan-100 text-sm font-bold mb-2">{{ __('Hours') }}:</label>
                            <input type="number" name="hours" id="hours" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ isset($project) ? $project->hours : old('hours') }}" />
                        </div>
                    </div>

                    @isset($users)
                    <div class="mb-4">
                        <label for="main_contact" class="block  text-cyan-100 text-sm font-bold mb-2">{{ __('Main Contact') }}:</label>
                        <select name="main_contact" id="main_contact" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50">
                            <option value="">N/A</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ (isset($project) && $project->main_contact == $user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endisset

                    @isset($companies)
                    <div class="mb-4">
                        <label for="company" class="block  text-cyan-100 text-sm font-bold mb-2">{{ __('Company') }}:</label>
                        <select name="company" id="company" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50">
                            <option value="">N/A</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endisset
                    <div class="flex justify-center">
                        <x-button type="submit">
                            @if(isset($project))
                            {{ __('Update Project') }}
                            @else
                            {{ __('Create Project') }}
                            @endif
                        </x-button>
                    </div>
                </form>
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
        </div>
    </div>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this project?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>