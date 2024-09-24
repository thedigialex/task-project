@props(['project'])

<form action="{{ route('projects.show') }}" method="POST" class="w-full md:w-1/4 p-2">
    @csrf
    <input type="hidden" name="project_id" value="{{ $project->id }}">
    <div class="shadow-lg p-6 rounded-md bg-header flex flex-col justify-between items-center">

        <div class="text-center mb-4 w-full">
            <x-fonts.highlight-header>{{ $project->truncateName() }}</x-fonts.highlight-header>
            <hr class="border-t-2 border-accent">
        </div>

        <div class="flex flex-col items-center">
            <div class="mb-4">
                <i class="fas fa-sitemap text-4xl text-text"></i>
            </div>
            <div>
                <x-primary-button type="submit">View Project</x-primary-button>
            </div>
        </div>
    </div>
</form>