@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])
<div class="flex flex-col bg-slate-900 sticky top-0 z-10">
    <div class="border-b border-slate-600 p-4">
        <div class="flex items-center m-px p-2">
            <div class="flex flex-row items-center justify-between w-full h-10">
                <div class="flex items-center">
                    <x-sub-header>{{ $headerTitle }}</x-sub-header>
                    @isset($linkUrl)
                    <a href="{{ $linkUrl }}" class="ml-2 text-blue-500 group relative hover:scale-105">
                        <i class="fa fa-cog text-2xl text-cyan-400 group-hover:text-cyan-100"></i>
                        <span class="hidden absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-cyan-100 text-xs px-2 py-1 rounded-md group-hover:block">Edit</span>
                    </a>
                    @endisset
                </div>
                @isset($subTitle)
                <div class="flex items-center ml-4">
                    <x-paragraph class="text-sm text-cyan-100">
                        {{ $subTitle }}
                    </x-paragraph>
                </div>
                @endisset
                @if ($completedTaskTime !== null && $remainingTaskTime !== null)
                <div class="flex flex-col items-end ml-4">
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
    </div>
</div>