@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])
<div class="flex flex-col bg-header sticky top-0 z-10 border-b border-border p-4">
    <div class="flex flex-row items-center justify-between w-full h-10">
        <div class="flex items-center">
            <x-sub-header>{{ $headerTitle }}</x-sub-header>
            @isset($linkUrl)
            <a href="{{ $linkUrl }}" class="ml-2 text-blue-500 group relative hover:scale-105">
                <i class="fa fa-cog text-2xl text-accent group-hover:text-highlight_accent"></i>
            </a>
            @endisset
        </div>
        @isset($subTitle)
        <div class="flex items-center ml-4">
            <x-paragraph class="text-sm text-text">
                {{ $subTitle }}
            </x-paragraph>
        </div>
        @endisset
        @if ($completedTaskTime !== null && $remainingTaskTime !== null)
        <div class="flex flex-col items-end ml-4">
            <p class="font-semibold text-xl text-accent leading-tight">
                {{ $completedTaskTime }} / {{ $remainingTaskTime }} Hours
            </p>
            <p class="text-sm text-accent">
                Completed / Remaining Task Time
            </p>
        </div>
        @endif
    </div>
</div>