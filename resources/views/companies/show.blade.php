<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $company->name ?? __('Awaiting account to be assigned a company') }}
                    <a href="{{ route('companies.edit', ['company' => $company->id]) }}" class="inline-block text-blue-500 hover:underline">
                        <i class="fas fa-pencil-alt ml-2"></i>
                    </a>
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ __('Company Details') }}</h2>
            <p>{{ $company->other_information }}</p>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl">{{ __('Clients') }}</h2>
                    @if ($users->count() > 0)
                    <div class="flex flex-wrap gap-5">
                        @foreach ($users as $user)
                        <x-user-card :name="$user->name" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
                        </x-user-card>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('No Users available for this company') }}</p>
                    @endif
                    <div class="flex justify-center pt-4">
                        <x-button>
                            <a href="{{ route('users.create') }}">{{ __('New User') }}</a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl">{{ __('Projects') }}</h2>
                    @if ($projects->count() > 0)
                    <div class="flex flex-wrap gap-5">
                        @foreach ($projects as $project)
                        <x-project-card :projectName="$project->name" :projectUrl="route('projects.show', ['projectId' => $project->id])" :imageUrl="'storage/project_images/' . $project->imageUrl">
                        </x-project-card>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('No projects available for this company') }}</p>
                    @endif
                    <div class="flex justify-center pt-4">
                        <x-button>
                            <a href="{{ route('projects.create', ['companyId' => $company->id]) }}">{{ __('New Project') }}</a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>