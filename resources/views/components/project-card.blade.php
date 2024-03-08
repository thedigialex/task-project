@props(['projectName', 'projectUrl', 'imageUrl'])

<div class="project-card p-5 rounded-md shadow-md">
    <div class="text-center mb-4">
        <img src="{{ asset($imageUrl != 'storage/project_images/' ?  $imageUrl : 'storage/project_images/default.jpg') }}" alt="Project Image" class="max-w-full h-auto rounded-md">
    </div>

    <div class="text-center mb-2.5">
        <h3 class="text-lg font-semibold">{{ $projectName }}</h3>
    </div>

    <div class="text-center">
        <x-button>
            <a href="{{ $projectUrl }}">View Project</a>
        </x-button>
    </div>
</div>