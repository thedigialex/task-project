<x-app-layout>
    <x-header :headerTitle="$project->name" :linkUrl="route('projects.edit', ['projectId' => $project->id])" :subTitle="'Target Date: ' . $project->target_date">
    </x-header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3 mb-6">
                <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-cyan-400">{{ __('Project Details') }}</h2>
                    <p class="text-cyan-100">{{ $project->description }}</p>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-cyan-400">{{ __('Main Contact') }}</h3>
                        <p class="text-cyan-400">
                            @if($mainContactUser)
                            <a href="mailto:{{ $mainContactUser->email }}" class="text-cyan-100 hover:underline">{{ $mainContactUser->name }}</a>
                            @else
                            <span>No contact available</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-index-section :title="'Phases'" :linkText="'New Phase'" :linkUrl="route('phases.create', ['projectId' => $project->id])" :phases="$phases"></x-index-section>
    <x-index-section :title="'Bugs / Issues'" :linkText="'New Bug'" :linkUrl="route('bugs.create', ['projectId' => $project->id])"  :bugs="$bugs"></x-index-section>
</x-app-layout>