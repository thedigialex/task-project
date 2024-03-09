@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])

<div class="bg-white shadow-md px-4 py-3">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $headerTitle }}
                @isset($linkUrl)
                <a href="{{ $linkUrl }}" class="text-blue-500 hover:text-blue-600 ml-2">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                @endisset
            </h2>
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
