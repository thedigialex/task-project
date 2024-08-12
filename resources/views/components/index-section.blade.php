@props(['title', 'linkText', 'linkUrl', 'projects', 'users', 'phases', 'bugs', 'tasks', 'statuses', 'projectId'])
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-4">
            <div class="p-6 flex justify-between items-center text-cyan-400 border-b border-slate-700">
                <h2 class="text-xl">{{ $title }}</h2>
                @if(empty($projectId))
                <a href="{{ $linkUrl }}">
                    <x-button>
                        {{ $linkText }}
                    </x-button>
                </a>
                @endif
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-5">
                    
                    
                    @isset($phases)
                    @if ($phases->count() > 0)
                    @foreach($phases as $phase)
                    <x-card :name="$phase->truncateName()" :linkUrl="route('phases.show', ['phaseId' => $phase->id])" :fa_icon="'fa fa-tasks'" :status="$phase->getCompletionPercentage()">
                    </x-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No phase currently for this project') }}</p>
                    @endif
                    @endisset
                    @isset($bugs)
                    @if ($bugs->count()> 0)
                    @foreach($bugs as $bug)
                    <x-card :name="$bug->truncateName()" :linkUrl="route('bugs.edit', $bug->id)" :fa_icon="'fa fa-bug'" :description="$bug->description">
                    </x-card>
                    @endforeach
                    @else
                    <p class="text-cyan-100">{{ __('No bugs/issues reported for this project.') }}</p>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>