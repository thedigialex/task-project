<x-app-layout>
    @if(isset($project))
    <x-header :headerTitle="'Edit Project'"></x-header>
    <x-forms.project-form :project="$project"></x-forms.project-form>
    @else
    <x-header :headerTitle="'Create Project'"></x-header>
    <x-forms.project-form ></x-forms.project-form>
    @endif
</x-app-layout>