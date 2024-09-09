<x-app-layout>
    @if(isset($company))
    <x-header :headerTitle="'Edit Company'"></x-header>
    <x-forms.company-form :company="$company"></x-forms.company-form>
    @else
    <x-header :headerTitle="'Create Company'"></x-header>
    <x-forms.company-form ></x-forms.company-form>
    @endif
</x-app-layout>