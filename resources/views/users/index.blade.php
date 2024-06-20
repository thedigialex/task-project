<x-app-layout>
    <x-header :headerTitle="'Users'"></x-header>
    @isset($users)
    <x-container :title="'Team Members'" :linkText="'New User'" :linkUrl="route('users.create')">
        <div class="flex flex-wrap gap-5">
            @isset($users)
            @if ($users->count() > 0)
            @foreach ($users as $user)
            <x-user-card :name="$user->truncatName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-user-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Users available for this company') }}</x-x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
    @else
    <x-container :title="'All Users'" :linkText="'New User'" :linkUrl="route('users.create')">
        <x-sub-header>{{ 'Staff' }}</x-sub-header>
        <div class="flex flex-wrap gap-5">
            @isset($staffUsers)
            @if ($staffUsers->count() > 0)
            @foreach ($staffUsers as $user)
            <x-user-card :name="$user->truncatName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-user-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
            @endif
            @endisset
        </div>
        <br>
        <x-sub-header>{{ 'Unassigned Users' }}</x-sub-header>
        <div class="flex flex-wrap gap-5">
            @isset($usersNeedingCompany)
            @if ($usersNeedingCompany->count() > 0)
            @foreach ($usersNeedingCompany as $user)
            <x-user-card :name="$user->truncatName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-user-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
            @endif
            @endisset
        </div>
        <br>
        <x-sub-header>{{ 'Assigned Users' }}</x-sub-header>
        <div class="flex flex-wrap gap-5">
            @isset($otherUsers)
            @if ($otherUsers->count() > 0)
            @foreach ($otherUsers as $user)
            <x-user-card :name="$user->truncatName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-user-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
    @endisset
</x-app-layout>