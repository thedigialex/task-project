<x-app-layout>
    <x-header :headerTitle="'Users'"></x-header>
    @isset($users)
    <x-container :title="'Team Members'" :linkText="'New User'" :linkUrl="route('users.create')">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            @isset($users)
            @if ($users->count() > 0)
            @foreach ($users as $user)
            <x-cards.user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-cards.user-card>
            @endforeach
            @else
            <x-fonts.paragraph>{{ __('No Users available for this company') }}</x-x-fonts.paragraph>
                @endif
                @endisset
        </div>
    </x-container>
    @else
    <x-container :title="'All Users'" :linkText="'New User'" :linkUrl="route('users.create')">
        <x-sub-header>{{ 'Staff' }}</x-sub-header>
        <hr>
        <div class="flex flex-wrap gap-5 justify-center my-8">
            @isset($staffUsers)
            @if ($staffUsers->count() > 0)
            @foreach ($staffUsers as $user)
            <x-cards.user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-cards.user-card>
            @endforeach
            @else
            <x-fonts.paragraph>{{ __('No Users available for this company') }}</x-fonts.paragraph>
            @endif
            @endisset
        </div>
        <br>
        <x-sub-header>{{ 'Assigned Users' }}</x-sub-header>
        <hr>
        <div class="flex flex-wrap gap-5 justify-center my-8">
            @isset($otherUsers)
            @if ($otherUsers->count() > 0)
            @foreach ($otherUsers as $user)
            <x-cards.user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-cards.user-card>
            @endforeach
            @else
            <x-fonts.paragraph>{{ __('No Users available for this company') }}</x-fonts.paragraph>
            @endif
            @endisset
        </div>
        <x-sub-header>{{ 'Unassigned Users' }}</x-sub-header>
        <hr>
        <div class="flex flex-wrap gap-5 justify-center my-8">
            @isset($usersNeedingCompany)
            @if ($usersNeedingCompany->count() > 0)
            @foreach ($usersNeedingCompany as $user)
            <x-cards.user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
            </x-cards.user-card>
            @endforeach
            @else
            <x-fonts.paragraph>{{ __('No Users available for this company') }}</x-fonts.paragraph>
            @endif
            @endisset
        </div>
        <br>
    </x-container>
    @endisset
</x-app-layout>