<x-app-layout>
    <x-header :headerTitle="$project->name" :linkUrl="route('projects.edit', ['projectId' => $project->id])" :subTitle="'Target Date: ' . $project->target_date">
    </x-header>
    <div x-data="{ activeTab: 'details' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center bg-border pt-4">
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'details', 'text-text': activeTab !== 'details'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'details'">
                Details
            </button>
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'phases', 'text-text': activeTab !== 'phases'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'phases'">
                Phases
            </button>
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'bugs', 'text-text': activeTab !== 'bugs'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'bugs'">
                Bugs
            </button>
            <button
                :class="{'border-b-2 border-accent text-accent': activeTab === 'settings', 'text-text': activeTab !== 'settings'}"
                class="py-2 px-4 focus:outline-none"
                @click="activeTab = 'settings'">
                Settings
            </button>
        </div>

        <div class="mt-8">
            <div x-show="activeTab === 'details'">
                <x-container :title="'Project Details'">
                    <x-fonts.paragraph>{{ $project->description }}</x-fonts.paragraph>
                    <br>
                    <x-fonts.highlight-header>{{ __('Main Contact') }}</x-fonts.highlight-header>
                    <x-fonts.paragraph> @if($mainContactUser)
                        <a href="mailto:{{ $mainContactUser->email }}" class="text-cyan-100 hover:underline">{{ $mainContactUser->name }}</a>
                        @else
                        <span>No contact available</span>
                        @endif</x-fonts.paragraph>
                </x-container>
            </div>

            <div x-show="activeTab === 'phases'">
                <x-container :title="'Phases'" :linkText="'New Phase'" :linkUrl="route('phases.create', ['projectId' => $project->id])">
                    <div class="flex flex-wrap gap-5 justify-center">
                        @isset($phases)
                        @if ($phases->count() > 0)
                        @foreach ($phases as $phase)
                        <x-cards.card :name="$project->truncateName()" :linkUrl="route('phases.show', ['phaseId' => $phase->id])" :fa_icon="'fa fa-project-diagram'">
                        </x-cards.card>
                        @endforeach
                        @else
                        <x-fonts.paragraph>{{ __('No Current Phases') }}</x-fonts.paragraph>
                        @endif
                        @endisset
                    </div>
                </x-container>
            </div>

            <div x-show="activeTab === 'bugs'">
                <x-container :title="'Bugs'" :linkText="'New Bug'" :linkUrl="route('bugs.create', ['projectId' => $project->id])">
                    <div class="flex flex-wrap gap-5 justify-center">
                        @isset($bugs)
                        @if ($bugs->count() > 0)
                        @foreach ($bugs as $bug)
                        <x-cards.card :name="$bug->truncateName()" :linkUrl="route('bugs.edit', ['bugId' => $bug->id])" :fa_icon="'fa fa-bug'">
                        </x-cards.card>
                        @endforeach
                        @else
                        <x-fonts.paragraph>{{ __('No Current Bugs') }}</x-fonts.paragraph>
                        @endif
                        @endisset
                    </div>
                </x-container>
            </div>

            <div x-show="activeTab === 'settings'">
                
    <x-forms.project-form :project="$project"></x-forms.project-form>
            </div>
        </div>
    </div>
</x-app-layout>