<x-app-layout>
    <x-header :headerTitle="$company->name" :linkUrl="route('companies.edit', ['companyId' => $company->id])"></x-header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-cyan-400">{{ __('Company Details') }}</h2>
            <p>{{ $company->other_information }}</p>
        </div>
    </div>
    <x-index-section :title="'Users'" :linkText="'New User'" :linkUrl="route('users.create')" :users="$users"></x-index-section>
    <x-index-section :title="'Projects'" :linkText="'New Project'" :linkUrl="route('projects.create')"  :projects="$projects"></x-index-section>
    </div>
</x-app-layout>