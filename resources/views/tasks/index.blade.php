<x-app-layout>
    <x-header :headerTitle="'Tasks'"></x-header>
    @foreach($projects as $project)
        <x-container :title="$project->name" :linkText="'Go To'" :linkUrl="route('projects.show', ['projectId' => $project->id])">
            <div class="flex gap-5">
                @foreach($statuses as $status)
                    <div class="flex-1">
                        <div class="bg-body text-text p-2 rounded-t">
                            <h3 class="text-lg font-bold">{{ ucfirst($status) }}</h3>
                        </div>
                        <div class="bg-body flex flex-col items-center gap-4 rounded-b p-2">
                            @foreach($project->phases as $phase)
                                @foreach($phase->tasks->where('status', $status) as $task)
                                    <x-task-card :task="$task"></x-task-card>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-container>
    @endforeach
</x-app-layout>
