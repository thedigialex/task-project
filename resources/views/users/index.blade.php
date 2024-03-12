<x-app-layout>
    <x-header :headerTitle="'Users'"></x-header>
    @isset($users)
    <x-index-section :title="'Clients'" :linkText="'New User'" :linkUrl="route('users.create')" :users="$users"></x-index-section>
    @else
    <x-index-section :title="'Need Company'" :linkText="'New User'" :linkUrl="route('users.create')" :users="$usersNeedingCompany"></x-index-section>
    <x-index-section :title="'Staff'" :linkText="'New User'" :linkUrl="route('users.create')" :users="$staffUsers"></x-index-section>
    <x-index-section :title="'Assigned a company'" :linkText="'New User'" :linkUrl="route('users.create')" :users="$otherUsers"></x-index-section>
    @endisset
</x-app-layout>