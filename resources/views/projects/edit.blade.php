<x-app-layout>
    @if(isset($project))
    <x-header :headerTitle="'Edit Project'"></x-header>
    @else
    <x-header :headerTitle="'Create Project'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method='POST' action="{{ isset($project) ? route('projects.update', ['projectId' => $project->id]) : route('projects.store') }}">
                    @csrf
                    @if(isset($project))
                    @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Project Name') }}:</label>
                        <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($project) ? $project->name : old('name') }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}:</label>
                        <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="3">{{ isset($project) ? $project->description : old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="target_date" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Target Date') }}:</label>
                        <input type="date" name="target_date" id="target_date" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($project) ? $project->target_date : old('target_date') }}" />
                    </div>

                    <div class="mb-4">
                        <label for="hours" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Hours') }}:</label>
                        <input type="number" name="hours" id="hours" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($project) ? $project->hours : old('hours') }}" />
                    </div>

                    @isset($users)
                    <div class="mb-4">
                        <label for="main_contact" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Main Contact') }}:</label>
                        <select name="main_contact" id="main_contact" class="form-select rounded-md shadow-sm mt-1 block w-full">
                            <option value="">N/A</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ (isset($project) && $project->main_contact == $user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endisset

                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Notes') }}:</label>
                        <textarea name="notes" id="notes" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="3">{{ isset($project) ? $project->notes : old('notes') }}</textarea>
                    </div>

                    @isset($companies)
                    <div class="mb-4">
                        <label for="company" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Company') }}:</label>
                        <select name="company" id="company" class="form-select rounded-md shadow-sm mt-1 block w-full">
                            <option value="">N/A</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endisset

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            @if(isset($project))
                            {{ __('Update Project') }}
                            @else
                            {{ __('Create Project') }}
                            @endif
                        </button>
                    </div>
                </form>
                @if(isset($project))
                <form method="POST" action="{{ route('projects.destroy', ['projectId' => $project->id]) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">{{ __('Delete Project') }}</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>