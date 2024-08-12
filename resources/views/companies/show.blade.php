<x-app-layout>
    <x-header :headerTitle="$company->name" :linkUrl="route('companies.edit', ['companyId' => $company->id])"></x-header>
    @isset($users)
        <x-container :title="'Team Members'" :linkText="'New User'" :linkUrl="route('users.create')">
            <div class="flex flex-wrap gap-5 justify-center my-8">
                @if ($users->count() > 0)
                    @foreach ($users as $user)
                        <x-user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])"></x-user-card>
                    @endforeach
                @else
                    <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
                @endif
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
                            <x-user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])"></x-user-card>
                        @endforeach
                    @else
                        <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
                    @endif
                @endisset
            </div>
            <br>
            <x-sub-header>{{ 'Unassigned Users' }}</x-sub-header>
            <hr>
            <div class="flex flex-wrap gap-5 justify-center my-8">
                @isset($usersNeedingCompany)
                    @if ($usersNeedingCompany->count() > 0)
                        @foreach ($usersNeedingCompany as $user)
                            <x-user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])"></x-user-card>
                        @endforeach
                    @else
                        <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
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
                            <x-user-card :name="$user->truncateName()" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])"></x-user-card>
                        @endforeach
                    @else
                        <x-paragraph>{{ __('No Users available for this company') }}</x-paragraph>
                    @endif
                @endisset
            </div>
        </x-container>
    @endisset
    <x-container :title="'Projects'" :linkText="'New Project'" :linkUrl="route('projects.create')">
        <div class="flex flex-wrap gap-5 justify-center">
            @isset($projects)
            @if ($projects->count() > 0)
            @foreach ($projects as $project)
            <x-card :name="$project->truncateName()" :linkUrl="route('projects.show', ['projectId' => $project->id])" :fa_icon="'fa fa-sitemap'">
            </x-card>
            @endforeach
            @else
            <x-paragraph>{{ __('No current projects') }}</x-paragraph>
            @endif
            @endisset
        </div>
    </x-container>
</x-app-layout>
