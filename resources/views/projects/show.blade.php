<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $project->name }}
                    <a href="{{ route('projects.edit', ['projectId' => $project->id]) }}" class="inline-block text-blue-500 hover:underline">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    Completion Date: {{ $project->completion_date }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Project Details') }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $project->description }}</p>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">{{ __('Main Contact') }}</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            <a href="mailto:{{ $mainContactUser->email }}" class="text-blue-500 hover:underline">{{ $mainContactUser->name }}</a>
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="mt-4">{{ __('Phase') }}</h2>
                    @if ($project->phases->count() > 0)
                    <div class="projects-container">
                        @foreach($project->phases as $phase)
                        <a href="{{ route('phases.show', ['phaseId' => $phase->id]) }}" class="project-card">
                            <div class="project-content">
                                <strong>{{ $phase->name }}</strong>
                                <br />
                                <p>Status:
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
                                    @endif
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-4">
                        <a href="{{ route('phases.create', ['projectId' => $project->id]) }}" class="dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200">{{ __('Create New Phase') }}</a>
                    </div>
                    @else
                    <p>{{ __('No phase currently for this project') }}</p>
                    @endif
                </div>
            </div>

            <div class="w-full  px-3">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Bugs/Issues') }}</h3>
                        <div class="flex justify-center mt-4">
                            <a href="{{ route('bugs.create', ['projectId' => $project->id]) }}" class="dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200">{{ __('Create New Bug') }}</a>
                        </div>
                    </div>
                    @if ($project->bugs->isNotEmpty())
                    <ul>
                        @foreach ($project->bugs as $bug)
                        <li>
                            <span>Status: {{ ucfirst($bug->status) }}</span><br />
                            <a href="{{ route('bugs.edit', $bug->id) }}">
                                {{ $bug->title }} - {{ $bug->description }}
                            </a><br /><br />

                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>{{ __('No bugs/issues reported for this project.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>