@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])

<div class="bg-slate-900 shadow-md px-4 py-3 sticky top-0">
    <div class="flex justify-between items-center">
    <div class="flex items-center flex-col md:flex-row">
    <h2 class="text-lg leading-6 font-medium text-cyan-400">{{ $headerTitle }}</h2>
    @isset($linkUrl)
    <a href="{{ $linkUrl }}" class="ml-2 text-blue-500 group relative hover:scale-105">
        <i class="fa fa-cog text-2xl text-cyan-400 group-hover:text-cyan-100"></i>
        <span class="hidden absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-cyan-100 text-xs px-2 py-1 rounded-md group-hover:block">Edit</span>
    </a>
    @endisset
</div>
@isset($subTitle)
<div class="flex items-center justify-center mt-1"> <!-- Center the content horizontally -->
    <p class="text-sm text-cyan-100">
        {{ $subTitle }}
    </p>
</div>
@endisset

        @if ($completedTaskTime !== null && $remainingTaskTime !== null)
        <div>
            <p class="font-semibold text-xl text-cyan-400 leading-tight">
                {{ $completedTaskTime }} / {{ $remainingTaskTime }} Hours
            </p>
            <p class="text-sm text-cyan-400">
                Completed / Remaining Task Time
            </p>
        </div>
        @endif
    </div>
</div>