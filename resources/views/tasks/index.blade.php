<x-app-layout>
    <x-header :headerTitle="'Tasks'"></x-header>
    @foreach($projects as $project)
    <x-container :title="$project->name" :linkText="'Go To'" :linkUrl="route('projects.show', ['projectId' => $project->id])">
        <div class="flex flex-wrap gap-5">
            @foreach($project->phases as $phase)
            @isset($phase->tasks)
            @if ($phase->tasks->count() > 0)
            <div x-data="{ tab: 'new', taskButtonClicked: true }" @task-info-click.window="taskButtonClicked = true">
                <div class="py-4">
                    @foreach($statuses as $status)
                    <button @click="tab = '{{ $status }}'" :class="{ 'bg-cyan-400 text-slate-700': tab === '{{ $status }}', 'bg-slate-700 text-cyan-400': tab !== '{{ $status }}' }" class="px-4 py-2 focus:outline-none hover:bg-cyan-400 hover:text-slate-700 rounded-t">
                        {{ ucfirst($status) }}
                    </button>
                    @endforeach
                </div>
                <div class="mt-2 flex flex-col gap-4">
                    @foreach($phase->tasks as $task)
                    <div x-show="tab === '{{ $task->status }}'" class="flex-none">
                        <x-task-card :task="$task"></x-task-card>
                    </div>
                    @endforeach
                    <template x-if="taskButtonClicked">
                        @include('tasks.show', ['task'])
                    </template>
                </div>
            </div>
            @else
            <x-paragraph>{{ __('No tasks') }}</x-paragraph>
            @endif
            @endisset
            @endforeach
        </div>
    </x-container>
    @endforeach
</x-app-layout>