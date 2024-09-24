<x-app-layout>
    <x-header :headerTitle="'Projects'"></x-header>
    <x-container :title="'Projects'" :linkText="'Add New'" :linkUrl="route('projects.create')">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($projects)
            @if ($projects->count() > 0)
            @foreach ($projects as $project)
            <x-cards.project-card :project="$project" />
            @endforeach
            @else
            <x-fonts.paragraph>{{ __('No current projects') }}</x-fonts.paragraph>
            @endif
            @endisset
        </div>
    </x-container>
</x-app-layout>