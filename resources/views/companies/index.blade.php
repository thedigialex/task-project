<x-app-layout>
    <x-header :headerTitle="'Companies'"></x-header>
    <x-container :title="'Companies'" :linkText="'New Company'" :linkUrl=" route('companies.create') ">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($companies)
            @if ($companies->count() > 0)
            @foreach($companies as $company)
            <x-card :name="$company->truncatName()" :linkUrl="route('companies.show', ['companyId' => $company->id])" :fa_icon="'fa fa-building'">
            </x-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Companies') }}</x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
</x-app-layout>