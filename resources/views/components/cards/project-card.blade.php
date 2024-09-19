@props(['project'])

<form action="{{ route('projects.show') }}" method="POST" class="w-full md:w-1/4 p-2">
    @csrf
    <input type="hidden" name="project_id" value="{{ $project->id }}">
    <div class="shadow-lg p-6 rounded-md bg-header h-[228px] flex flex-col justify-between">

        <div class="text-center mb-4">
            <x-fonts.highlight-header>{{ $project->truncateName() }}</x-fonts.highlight-header>
            <hr class="border-t-2 border-accent">
        </div>

        <div class="flex items-center">
            <div class="mr-4">
                @if ($project->image_url)
                    <img src="{{ asset($project->image_url != 'storage/project_images/' ?  $project->image_url : 'storage/project_images/default.jpg') }}" alt="Project Image" class="max-w-full h-auto rounded-md">
                @else
                    <i class="fa fa-sitemap text-4xl text-accent"></i>
                @endif
            </div>
            <div>
                <x-fonts.paragraph>{{ $project->truncateDescription() }}</x-fonts.paragraph>
            </div>
        </div>

        <!-- Button at the bottom -->
        <div class="text-center mt-auto">
            <x-primary-button type="submit">View Project</x-primary-button>
        </div>
    </div>
</form>
