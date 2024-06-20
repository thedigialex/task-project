@props(['title', 'linkUrl', 'linkText'])
<div class="py-6 max-w-7xl mx-auto px-2">
    <div class="bg-slate-900 shadow-sm sm:rounded-lg">
        <div class="p-4 flex justify-between items-center border-b border-slate-700 h-20">
            <x-sub-header>{{ $title }}</x-sub-header>
            @if(!empty($linkUrl))
            <a href="{{ $linkUrl }}">
                <x-primary-button>
                    {{ $linkText }}
                </x-primary-button>
            </a>
            @endif
        </div>
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>