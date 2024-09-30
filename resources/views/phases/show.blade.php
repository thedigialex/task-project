<x-app-layout>
    <x-header :headerTitle="'Phase: ' . $phase->name" :subTitle="'Target Date: ' . $phase->target_date" :completedTaskTime="$completedTaskTime" :remainingTaskTime="$remainingTaskTime">
    </x-header>
    <div x-data="{ activeTab: 'tasks' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center bg-border pt-4 px-0 md:px-8">
            <button
                :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'tasks', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'tasks'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'tasks'">
                Tasks
            </button>
            <button
                :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'details', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'details'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'details'">
                Goal
            </button>
            <button
                :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'settings', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'settings'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'settings'">
                Settings
            </button>
        </div>
        <div>
            <div x-show="activeTab === 'tasks'">
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
            </div>
            <div x-show="activeTab === 'settings'">
                <x-forms.phase-form :phase="$phase"></x-forms.phase-form>
            </div>
            <div x-show="activeTab === 'details'">
                <x-container :title="'Phase Goal'">
                    <div class="w-full lg:w-1/2 mx-auto bg-header p-8 rounded-md">
                        <x-fonts.sub-header>Goal</x-fonts.sub-header>
                        <x-fonts.paragraph>{{ $phase->goal }}</x-fonts.paragraph>
                </x-container>
            </div>
        </div>
    </div>
</x-app-layout>