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
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ __('Project Details') }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $project->description }}</p>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold dark:text-white">{{ __('Main Contact') }}</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            <a href="mailto:{{ $mainContactUser->email }}" class="text-blue-500 hover:underline">{{ $mainContactUser->name }}</a>
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-xl dark:text-white">{{ __('Phase') }}</h2>
                    @if ($project->phases->count() > 0)
                    <div class="projects-container">
                        @foreach($project->phases as $phase)
                        <a href="{{ route('phases.show', ['phaseId' => $phase->id]) }}">
                            <x-phase-card :phaseName="$phase->name" :phaseDescription="$phase->description" :completionPercentage="$phase->getCompletionPercentage()">
                            </x-phase-card>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('No phase currently for this project') }}</p>
                    @endif
                    <div class="flex justify-center mt-4">
                        <x-button>
                            <a href="{{ route('phases.create', ['projectId' => $project->id]) }}">{{ __('New Phase') }}</a>
                        </x-button>
                    </div>
                </div>
            </div>

            <div class="w-full  px-3">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Bugs/Issues') }}</h3>
                        <div class="flex justify-center mt-4">
                            <x-button>
                                <a href="{{ route('bugs.create', ['projectId' => $project->id]) }}">{{ __('New Bug') }}</a>
                            </x-button>
                        </div>
                    </div>
                    @if ($project->bugs->isNotEmpty())
                    <ul>
                        @foreach ($project->bugs as $bug)
                        <li>
                            <span>Status: {{ ucfirst($bug->status) }}</span><br />
                            <a href="{{ route('bugs.edit', $bug->id) }}">
                                {{ $bug->title }} - {{ $bug->description }}
                            </a>
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