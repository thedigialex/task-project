<x-app-layout>
    <x-header :headerTitle="$phase->name" :linkUrl="route('phases.edit', ['phaseId' => $phase->id])" :subTitle="'Target Date: ' . $phase->target_date" :completedTaskTime="$completedTaskTime" :remainingTaskTime="$remainingTaskTime">
    </x-header>
    <x-container :title="'Tasks'" :linkText="'New Task'" :linkUrl=" route('tasks.create', ['phaseId' => $phase->id])">
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
</x-app-layout>