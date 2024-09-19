<x-app-layout>
    <x-header :headerTitle="$project->name" :linkUrl="route('projects.edit', ['projectId' => $project->id])" :subTitle="'Target Date: ' . $project->target_date">
    </x-header>
    <div x-data="{ activeTab: 'details' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center bg-border pt-4 px-0 md:px-8">
            <button
            :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'details', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'details'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'details'">
                Details
            </button>
            <button
            :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'phases', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'phases'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'phases'">
                Phases
            </button>
            <button
            :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'bugs', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'bugs'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'bugs'">
                Bugs
            </button>
            <button
            :class="{'bg-accent text-header rounded-t-lg border-b-2 border-accent font-bold': activeTab === 'settings', 
            'hover:border-b-2 hover:border-accent hover:text-accent text-text': activeTab !== 'settings'}"
                class="py-2 px-4 focus:outline-none flex-grow"
                @click="activeTab = 'settings'">
                Settings
            </button>
        </div>

        <div >
            <div x-show="activeTab === 'details'">
                <x-container :title="'Project Details'">
                    <x-fonts.paragraph>{{ $project->description }}</x-fonts.paragraph>
                </x-container>
            </div>

            <div x-show="activeTab === 'phases'">
                <x-container :title="'Phases'" :linkText="'New Phase'" :linkUrl="route('phases.create', ['projectId' => $project->id])">
                    <div class="flex flex-wrap gap-5 justify-center">
                        @isset($phases)
                        @if ($phases->count() > 0)
                        @foreach ($phases as $phase)
                        <x-cards.phase-card :phase="$phase">
                        </x-cards.phase-card>
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