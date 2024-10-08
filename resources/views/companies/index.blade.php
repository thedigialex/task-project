<x-app-layout>
    <x-header :headerTitle="'Companies'"></x-header>
    <x-container :title="'Companies'" :linkText="'Add New'" :linkUrl=" route('companies.create') ">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($companies)
            @if ($companies->count() > 0)
            @foreach ($companies as $company)
            <x-cards.basic-card
                :model="$company"
                route="companies.show"
                faIcon="fas fa-building"
                buttonName="Company" />
            @endforeach
            @else
            <x-fonts.paragraph>{{ __('No current company') }}</x-fonts.paragraph>
            @endif
            @endisset
        </div>
    </x-container>
</x-app-layout>