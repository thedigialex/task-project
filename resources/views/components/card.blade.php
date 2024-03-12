@props(['name', 'linkUrl', 'imageUrl', 'fa_icon', 'status'])

<div class="project-card p-5 rounded-md shadow-md">
    <div class="text-center mb-4">
        <a href="{{ $linkUrl }}">
            @isset($fa_icon)
            <i class="{{ $fa_icon }} fa-2x"></i>
            @else
            <img src="{{ asset($imageUrl != 'storage/project_images/' ?  $imageUrl : 'storage/project_images/default.jpg') }}" alt="Project Image" class="max-w-full h-auto rounded-md">
            @endisset
        </a>
    </div>

    <div class="text-center mb-2.5">
        <h3 class="text-lg font-semibold">{{ $name }}</h3>
    </div>
    @isset ($status)
    <div class="text-center mb-2.5">
        <p>Status:
            @if ($status == 100)
            <span class="text-green-500">
                {{ $status }}%
            </span>
            @else
            <span class="text-yellow-500">
                {{ $status }}%
            </span>
            @endif
        </p>
    </div>
    @endisset
</div>