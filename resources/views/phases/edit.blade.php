<x-app-layout>
    @if(isset($phase))
    <x-header :headerTitle="'Edit Phase'"></x-header>
    <x-forms.phase-form :phase="$phase" :project="$project"></x-forms.phase-form>
    @else
    <x-header :headerTitle="'Create Phase'"></x-header>
    <x-forms.phase-form :project="$project"></x-forms.phase-form>
    @endif
</x-app-layout>
