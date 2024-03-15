@props(['title', 'linkText', 'linkUrl', 'companies', 'projects', 'users', 'phases', 'bugs', 'tasks', 'statuses', 'projectId'])
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-4">
            <div class="p-6 flex justify-between items-center text-cyan-400 border-b border-slate-700">
                <h2 class="text-xl">{{ $title }}</h2>
                @if(empty($projectId))
                <x-button>
                    <a href="{{ $linkUrl }}">{{ $linkText }}</a>
                </x-button>
                @endif
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-5">
                    @isset($companies)
                    @if ($companies->count() > 0)
                    @foreach($companies as $company)
                    <x-card :name="$company->name" :linkUrl="route('companies.show', ['companyId' => $company->id])" :fa_icon="'fa fa-building'">
                    </x-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No Companies') }}</p>
                    @endif
                    @endisset
                    @isset($projects)
                    @if ($projects->count() > 0)
                    @foreach ($projects as $project)
                    <x-card :name="$project->name" :linkUrl="route('projects.show', ['projectId' => $project->id])" :fa_icon="'fa fa-sitemap'">
                    </x-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No current projects') }}</p>
                    @endif
                    @endisset
                    @isset($users)
                    @if ($users->count() > 0)
                    @foreach ($users as $user)
                    <x-user-card :name="$user->name" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
                    </x-user-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No Users available for this company') }}</p>
                    @endif
                    @endisset
                    @isset($phases)
                    @if ($phases->count() > 0)
                    @foreach($phases as $phase)
                    <x-card :name="$phase->name" :linkUrl="route('phases.show', ['phaseId' => $phase->id])" :fa_icon="'fa fa-tasks'" :status="$phase->getCompletionPercentage()">
                    </x-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No phase currently for this project') }}</p>
                    @endif
                    @endisset
                    @isset($bugs)
                    @if ($bugs->count()> 0)
                    @foreach($bugs as $bug)
                    <x-card :name="$bug->title" :linkUrl="route('bugs.edit', $bug->id)" :fa_icon="'fa fa-bug'" :description="$bug->description">
                    </x-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No bugs/issues reported for this project.') }}</p>
                    @endif
                    @endisset
                </div>
                @isset($tasks)
                @if ($tasks->count() > 0)
                <div x-data="{ tab: 'new' }">
                    <div class="py-4">
                        @foreach($statuses as $status)
                        <button @click="tab = '{{ $status }}'" :class="{ 'bg-cyan-400 text-slate-700': tab === '{{ $status }}', 'bg-slate-700 text-cyan-400': tab !== '{{ $status }}' }" class="px-4 py-2 focus:outline-none hover:bg-cyan-400 hover:text-slate-700 rounded-t">
                            {{ ucfirst($status) }}
                        </button>
                        @endforeach
                    </div>
                    <div class="mt-2 flex flex-wrap ">
                        @foreach($tasks as $task)
                        @isset($projectId)
                        @if($projectId == $task->phase->project->id)
                        <div x-show="tab === '{{ $task->status }}'" class="flex-none mr-2 mb-2">
                            <x-task-card :task="$task"></x-task-card>
                        </div>
                        @endif
                        @else
                        <div x-show="tab === '{{ $task->status }}'" class="flex-none mr-2 mb-2">
                            <x-task-card :task="$task"></x-task-card>
                        </div>
                        @endisset
                        @endforeach
                    </div>
                </div>
                @else
                <p class="text-cyan-100">{{ __('No tasks') }}</p>
                @endif
                @endisset
            </div>
        </div>
    </div>
</div>