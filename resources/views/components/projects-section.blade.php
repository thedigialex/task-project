    
@props(['projects' => '', 'company'])
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl">{{ __('Projects') }}</h2>
                    @if ($projects->count() > 0)
                    <div class="flex flex-wrap gap-5">
                        @foreach ($projects as $project)
                        <x-card :name="$project->name" :linkUrl="route('projects.show', ['projectId' => $project->id])" :imageUrl="'storage/project_images/' . $project->imageUrl">
                        </x-card>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('No projects available for this company') }}</p>
                    @endif
                    <div class="flex justify-center pt-4">
                        <x-button>
                            <a href="{{ route('projects.create') }}">{{ __('New Project') }}</a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>