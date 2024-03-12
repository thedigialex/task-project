<x-app-layout>
    <x-header :headerTitle="'Companies'"></x-header>
    <x-index-section :title="'Companies'" :linkText="'New Company'" :linkUrl=" route('companies.create') " :companies="$companies"></x-index-section>
</x-app-layout>