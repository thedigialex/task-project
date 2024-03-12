@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])

<div class="bg-white shadow-md px-4 py-3">
    <div class="flex justify-between items-center">
        <div>
            @isset($linkUrl)
            <a href="{{ $linkUrl }}" class="text-blue-500 group relative">
                <h2 class="text-lg leading-6 font-medium text-gray-900">{{ $headerTitle }}</h2>
                <span class="hidden absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded-md group-hover:block">Edit</span>
            </a>
            @else
            <h2 class="text-lg leading-6 font-medium text-gray-900">{{ $headerTitle }}</h2>
            @endisset
            @isset($subTitle)
            <p class="text-sm text-gray-500 mt-1">
                {{ $subTitle }}
            </p>
            @endisset
        </div>
        @if ($completedTaskTime !== null && $remainingTaskTime !== null)
        <div>
            <p class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $completedTaskTime }} / {{ $remainingTaskTime }} Hours
            </p>
            <p class="text-sm text-gray-500">
                Completed / Remaining Task Time
            </p>
        </div>
        @endif
    </div>
</div>