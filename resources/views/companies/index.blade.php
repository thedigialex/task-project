<x-app-layout>
    <x-header :headerTitle="'Companies'"></x-header>
    <div class="py-12">
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg p-6">
            @if ($companies->count() > 0)
            <div class="projects-container">
                @foreach($companies as $company)
                <x-card :name="$company->name" :linkUrl="route('companies.admin', ['company' => $company->id])" :imageUrl="'storage/project_images/' . $company->imageUrl">
                </x-card>
                @endforeach
            </div>
            @else
            <p>{{ __('No Companies') }}</p>
            @endif
            <div class="flex justify-center">
                <x-button>
                    <a href="{{ route('companies.create') }}">{{ __('New Company') }}</a>
                </x-button>
            </div>
        </div>
    </div>
</x-app-layout>