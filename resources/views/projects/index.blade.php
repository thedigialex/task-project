<x-app-layout>
    <x-header :headerTitle="'Projects'"></x-header>
    <x-container :title="'Projects'" :linkText="'New Project'" :linkUrl="route('projects.create')">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($projects)
            @if ($projects->count() > 0)
            @foreach ($projects as $project)
            <x-card :name="$project->truncatName()" :linkUrl="route('projects.show', ['projectId' => $project->id])" :fa_icon="'fa fa-sitemap'">
            </x-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No current projects') }}</x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
</x-app-layout>