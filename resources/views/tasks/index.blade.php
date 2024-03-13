<x-app-layout>
    <x-header :headerTitle="'Tasks'"></x-header>
    @foreach($projects as $project)
    <x-index-section :title="'Tasks'" :linkText="'New Task'" :linkUrl=" route('tasks.create', ['phaseId' => 1])" :tasks="$sortedTasks" :statuses="$statuses" :projectId="$project->id"></x-index-section>
    @endforeach
</x-app-layout>