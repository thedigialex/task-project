@props(['name', 'linkUrl', 'imageUrl', 'fa_icon', 'status'])

<a href="{{ $linkUrl }}">
    <div class="group shadow-lg p-5 rounded-md transition-transform duration-200 w-48 shadow-lg hover:scale-105">
        <div class="text-center mb-4">
            @isset($fa_icon)
            <i class="{{ $fa_icon }} text-4xl text-gray-500 group-hover:text-blue-500"></i>
            @else
            <img src="{{ asset($imageUrl != 'storage/project_images/' ?  $imageUrl : 'storage/project_images/default.jpg') }}" alt="Project Image" class="max-w-full h-auto rounded-md">
            @endisset
        </div>
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-semibold text-gray-500 group-hover:text-blue-500">{{ $name }}</h3>
        </div>
        @isset ($status)
        <div class="text-center mb-2.5 text-gray-500 group-hover:text-blue-500">
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
</a>