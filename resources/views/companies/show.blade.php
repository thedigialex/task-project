<x-app-layout>
    <x-header :headerTitle="$company->name" :linkUrl="route('companies.edit', ['company' => $company->id])"></x-header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ __('Company Details') }}</h2>
            <p>{{ $company->other_information }}</p>
        </div>
    </div>
    <x-user-section :users="$users"></x-user-section>
    <x-projects-section :projects="$projects" :company="$company"></x-projects-section>
    </div>
</x-app-layout>