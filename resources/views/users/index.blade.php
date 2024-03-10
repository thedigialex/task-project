<x-app-layout>
    <x-header :headerTitle="'Users'"></x-header>
    @isset($users)
    <x-user-section :title="'Clients'" :users="$users"></x-user-section>
    @else
    <x-user-section :title="'Need Company'" :users="$usersNeedingCompany"></x-user-section>
    <x-user-section :title="'Staff'" :users="$staffUsers"></x-user-section>
    <x-user-section :title="'Assigned a company'" :users="$otherUsers"></x-user-section>
    @endisset
</x-app-layout>