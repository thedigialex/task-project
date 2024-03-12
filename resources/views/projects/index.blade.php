<x-app-layout>
    <x-header :headerTitle="'Projects'"></x-header>
    <x-index-section :title="'Projects'" :linkText="'New Project'" :linkUrl="route('projects.create')"  :projects="$projects"></x-index-section>
</x-app-layout>