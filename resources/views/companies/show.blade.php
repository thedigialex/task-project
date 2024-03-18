<x-app-layout>
    <x-header :headerTitle="$company->name" :linkUrl="route('companies.edit', ['companyId' => $company->id])"></x-header>
    <x-index-section :title="'Users'" :linkText="'New User'" :linkUrl="route('users.create')" :users="$users"></x-index-section>
    <x-index-section :title="'Projects'" :linkText="'New Project'" :linkUrl="route('projects.create')"  :projects="$projects"></x-index-section>
</x-app-layout>
