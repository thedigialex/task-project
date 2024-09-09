<x-app-layout>
    <x-header :headerTitle="$company->name"></x-header>

    <div x-data="{ activeTab: 'projects' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center bg-border pt-4">
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'projects', 'text-text': activeTab !== 'projects'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'projects'">
                Projects
            </button>
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'team-members', 'text-text': activeTab !== 'team-members'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'team-members'">
                Team Members
            </button>
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'settings', 'text-text': activeTab !== 'settings'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'settings'">
                Settings
            </button>
        </div>

        <!-- Tab Content -->
        <div class="mt-8">
            <!-- Projects Tab -->
            <div x-show="activeTab === 'projects'">
                <x-container :title="'Projects'" :linkText="'Add New'" :linkUrl="route('projects.create')">
                    <div class="flex flex-wrap gap-5 justify-center">
                        @isset($projects)
                        @if ($projects->count() > 0)
                        @foreach ($projects as $project)
                        <x-cards.project-card :project="$project" />
                        @endforeach
                        @else
                        <x-fonts.paragraph>{{ __('No current projects') }}</x-fonts.paragraph>
                        @endif
                        @endisset
                    </div>
                </x-container>
            </div>

            <!-- Team Members Tab -->
            <div x-show="activeTab === 'team-members'">
                <x-container :title="'Users'" :linkText="'Add New'" :linkUrl="route('users.create')">
                    <div class="flex flex-wrap gap-5 justify-center">
                        @isset($users)
                        @if ($users->count() > 0)
                        @foreach ($users as $user)
                        <x-cards.user-card :user="$user" />
                        @endforeach
                        @else
                        <x-fonts.paragraph>{{ __('No current users') }}</x-fonts.paragraph>
                        @endif
                        @endisset
                    </div>
                </x-container>
            </div>

            <div x-show="activeTab === 'settings'">
                <x-forms.company-form :company="$company"></x-forms.company-form>
            </div>
        </div>
    </div>
</x-app-layout>