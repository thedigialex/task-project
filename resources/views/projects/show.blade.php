<x-app-layout>
    <x-header :headerTitle="$project->name" :linkUrl="route('projects.edit', ['projectId' => $project->id])" :subTitle="'Target Date: ' . $project->target_date">
    </x-header>
    <x-container :title="'Project Details'">
        <x-paragraph>{{ $project->description }}</x-paragraph>
        <br>
        <x-highlight-header>{{ __('Main Contact') }}</x-highlight-header>
        <x-paragraph> @if($mainContactUser)
            <a href="mailto:{{ $mainContactUser->email }}" class="text-cyan-100 hover:underline">{{ $mainContactUser->name }}</a>
            @else
            <span>No contact available</span>
            @endif</x-paragraph>
    </x-container>
    <x-container :title="'Phases'" :linkText="'New Phase'" :linkUrl="route('phases.create', ['projectId' => $project->id])">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($phases)
            @if ($phases->count() > 0)
            @foreach ($phases as $phase)
            <x-card :name="$project->truncateName()" :linkUrl="route('phases.show', ['phaseId' => $phase->id])" :fa_icon="'fa fa-project-diagram'">
            </x-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Current Phases') }}</x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
    <x-container :title="'Bugs'" :linkText="'New Bug'" :linkUrl="route('bugs.create', ['projectId' => $project->id])">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($bugs)
            @if ($bugs->count() > 0)
            @foreach ($bugs as $bug)
            <x-card :name="$bug->truncateName()" :linkUrl="route('bugs.edit', ['bugId' => $bug->id])" :fa_icon="'fa fa-bug'">
            </x-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Current Bugs') }}</x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
</x-app-layout>