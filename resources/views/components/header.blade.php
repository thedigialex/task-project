@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])
<div class="flex flex-col bg-header sticky top-0 z-10 border-l border-border p-4">
    <div class="flex flex-row items-center justify-between w-full h-10">
        <div class="flex items-center">
            <x-sub-header>{{ $headerTitle }}</x-sub-header>
        </div>
        @isset($subTitle)
        <div class="flex items-center ml-4">
            <x-fonts.paragraph class="text-sm text-text">
                {{ $subTitle }}
            </x-fonts.paragraph>
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