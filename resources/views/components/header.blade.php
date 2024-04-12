@props(['headerTitle' => '', 'linkUrl', 'subTitle', 'completedTaskTime' => null, 'remainingTaskTime' => null])
<div class="bg-slate-900 shadow-md sticky top-0 p-6 min-h-28 flex justify-between items-center">
    <div class="flex flex-col items-center">
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
        <div class="flex items-center justify-center mt-1">
            <p class="text-sm text-cyan-100">
                {{ $subTitle }}
            </p>
        </div>
        @endisset
    </div>
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
    <div class="flex items-center">
        <x-dropdown width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-cyan-400 bg-slate-900 dark:bg-gray-800 hover:text-cyan-400 focus:outline-none transition ease-in-out duration-150">
                    {{ Auth::user()->name }}
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>