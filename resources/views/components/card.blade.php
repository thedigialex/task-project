@props(['name', 'linkUrl', 'imageUrl', 'description'])

<div class="project-card p-5 rounded-md shadow-md">
    <div class="text-center mb-4">
        <a href="{{ $linkUrl }}">
            <img src="{{ asset($imageUrl != 'storage/project_images/' ?  $imageUrl : 'storage/project_images/default.jpg') }}" alt="Project Image" class="max-w-full h-auto rounded-md">
        </a>
    </div>

    <div class="text-center mb-2.5">
        <h3 class="text-lg font-semibold">{{ $name }}</h3>
    </div>
    @isset ($description)
    <div class="text-center mb-2.5">
        <p>Status:
            @if ($description == 100)
            <span class="text-green-500">
                {{ $description }}%
            </span>
            @else
            <span class="text-yellow-500">
                {{ $description }}%
            </span>
            @endif
        </p>
    </div>
    @endisset
</div>