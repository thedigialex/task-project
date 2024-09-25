<x-app-layout>
    <x-header :headerTitle="'Company: ' . $company->name"></x-header>

    <div x-data="{ activeTab: 'projects' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center bg-border pt-4 px-0 md:px-8">
            <button
                :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'projects', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'projects'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'projects'">
                Projects
            </button>
            <button
                :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'team-members', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'team-members'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'team-members'">
                Team
            </button>
            <button
                :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'settings', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'settings'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'settings'">
                Settings
            </button>
        </div>

        <!-- Tab Content -->
        <div>
            <!-- Projects Tab -->
            <div x-show="activeTab === 'projects'">
                <x-container :title="'Projects'" :linkText="'Add New'" :linkUrl="route('projects.create')">
                    <div class="flex flex-wrap gap-4 justify-center">
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