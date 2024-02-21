<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $company->name ?? __('Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($company)
                    <p>{{ __('Company Name') }}: {{ $company->name }}</p>
                    <p>{{ __('Other Company Information') }}: {{ $company->other_information }}</p>
                    {{-- Add more fields as needed --}}
                    <a href="{{ route('projects.create', ['companyId' => $company->id]) }}" class="text-blue-500 hover:underline">{{ __('Create New Project') }}</a>

                    {{-- List of projects --}}
                    <h2 class="mt-4">{{ __('Projects') }}</h2>
                    @if ($projects->count() > 0)
                    <ul>
                        @foreach ($projects as $project)
                        <li>
                            <strong><a href="{{ route('projects.show', ['projectId' => $project->id]) }}">{{ $project->name }}</a></strong> - {{ $project->description }}
                            {{-- Add more project information as needed --}}
                        </li>
                        @endforeach

                    </ul>
                    @else
                    <p>{{ __('No projects available for this company') }}</p>
                    @endif
                    @else
                    <p>{{ __('Company information not available') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>