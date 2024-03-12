@props(['title', 'linkText', 'linkUrl', 'companies', 'projects', 'users', 'phases', 'bugs'])
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 flex justify-between items-center text-gray-900 dark:text-gray-100 border-b border-gray-200">
                <h2 class="text-xl">{{ $title }}</h2>
                <x-button>
                    <a href="{{ $linkUrl }}">{{ $linkText }}</a>
                </x-button>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-5">
                    @isset($companies)
                    @if ($companies->count() > 0)
                    @foreach($companies as $company)
                    <x-card :name="$company->name" :linkUrl="route('companies.show', ['companyId' => $company->id])" :imageUrl="'storage/project_images/' . $company->imageUrl">
                    </x-card>
                    @endforeach
                    @else
                    <p>{{ __('No Companies') }}</p>
                    @endif
                    @endisset
                    @isset($projects)
                    @if ($projects->count() > 0)
                    @foreach ($projects as $project)
                    <x-card :name="$project->name" :linkUrl="route('projects.show', ['projectId' => $project->id])" :imageUrl="'storage/project_images/' . $project->imageUrl">
                    </x-card>
                    @endforeach
                    @else
                    <p>{{ __('No current projects') }}</p>
                    @endif
                    @endisset
                    @isset($users)
                    @if ($users->count() > 0)
                    @foreach ($users as $user)
                    <x-user-card :name="$user->name" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
                    </x-user-card>
                    @endforeach
                    @else
                    <p>{{ __('No Users available for this company') }}</p>
                    @endif
                    @endisset
                    @isset($phases)
                    @if ($phases->count() > 0)
                    @foreach($phases as $phase)
                    <x-card :name="$phase->name" :linkUrl="route('phases.show', ['phaseId' => $phase->id])" :imageUrl="'storage/project_images/' . $phase->imageUrl" :status="$phase->getCompletionPercentage()">
                    </x-card>
                    @endforeach
                    @else
                    <p>{{ __('No phase currently for this project') }}</p>
                    @endif
                    @endisset
                    @isset($bugs)
                    @if ($bugs->count()> 0)
                    @foreach($bugs as $bug)
                    <x-card :name="$bug->title" :linkUrl="route('bugs.edit', $bug->id)" :fa_icon="'fa fa-bug'" :description="$bug->description">
                    </x-card>
                    @endforeach
                    @else
                    <p>{{ __('No bugs/issues reported for this project.') }}</p>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>