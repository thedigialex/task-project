<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $project->name }}
                    <a href="{{ route('projects.edit', ['projectId' => $project->id]) }}" class="inline-block text-blue-500 hover:underline">
                        <i class="fas fa-pencil-alt ml-2"></i>
                    </a>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    Completion Date: {{ $project->completion_date }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ __('Project Details') }}</h2>
            <p class="text-gray-700 dark:text-gray-300">{{ $project->description }}</p>
            <div class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">{{ __('Main Contact') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    <a href="mailto:{{ $mainContactUser->email }}" class="text-blue-500 hover:underline">{{ $mainContactUser->name }}</a>
                </p>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="">{{ __('Phases') }}</h2>
                    @if ($project->phases->count() > 0)
                    <div class="projects-container">
                    @foreach($project->phases as $phase)
                        <a href="{{ route('phases.show', ['phaseId' => $phase->id]) }}" class="project-card hover:border-gray-500">
                            <div class="project-content">
                                <strong>{{ $phase->name }}</strong>
                                <br/><p>Status:
                                @if ($phase->tasks->count() > 0)
                                @php
                                $completionPercentage = round(($phase->tasks->where('status', 'completed')->count() / $phase->tasks->count()) * 100);
                                @endphp
                                @if ($completionPercentage == 100)
                                <span class="text-green-500">
                                    {{ $completionPercentage }}%
                                </span>
                                @else
                                <span class="text-yellow-500">
                                    {{ $completionPercentage }}%
                                </span>
                                @endif
                                @else
                                <span class="text-gray-500">{{ __('No tasks') }}</span>
                                @endif</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('No phase currently for this project') }}</p>
                    @endif
                    <div class="flex justify-center pt-4">
                        <a href="{{  route('phases.create', ['projectId' => $project->id]) }}" class="dark:text-black hover:text-white bg-gray-200 hover:bg-gray-400 shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200 ring-1 ring-gray-200 hover:ring-gray-400">{{ __('Create New Phase') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
