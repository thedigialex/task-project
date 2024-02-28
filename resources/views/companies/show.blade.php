<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $company->name ?? __('Awaiting account to be assigned a company') }}
                    <a href="{{ route('companies.edit', ['company' => $company->id]) }}" class="inline-block text-blue-500 hover:underline">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">{{ __('Company Details') }}</h2>
            <p>{{ $company->other_information }}</p>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="mt-4">{{ __('Projects') }}</h2>
                    @if ($projects->count() > 0)
                    <div class="projects-container">
                        @foreach ($projects as $project)
                        <a href="{{ route('projects.show', ['projectId' => $project->id]) }}" class="project-card">
                            <div class="project-content">
                                <strong>{{ $project->name }}</strong>
                                <p>{{ $project->description }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('No projects available for this company') }}</p>
                    @endif
                    <div class="flex justify-center">
                        <a href="{{ route('projects.create', ['companyId' => $company->id]) }}" class="dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200">{{ __('Create New Project') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>