<x-app-layout>
    <x-header :headerTitle="$phase->name" :linkUrl="route('phases.edit', ['phaseId' => $phase->id])" :subTitle="'Target Date: ' . $phase->target_date" :completedTaskTime="$completedTaskTime" :remainingTaskTime="$remainingTaskTime">
    </x-header>
    <x-index-section :title="'Tasks'" :linkText="'New Task'" :linkUrl=" route('tasks.create', ['phaseId' => $phase->id])" :tasks="$sortedTasks" :statuses="$statuses"></x-index-section>
</x-app-layout>