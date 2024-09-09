@props(['title', 'linkUrl', 'linkText'])
<div class="py-6 max-w-7xl mx-auto px-2">
    <div class="border border-border shadow-sm sm:rounded-lg">
        <div class="p-4 flex justify-between items-center bg-header rounded-t h-20">
            <x-fonts.sub-header>{{ $title }}</x-fonts.sub-header>
            @if(!empty($linkUrl))
            <a href="{{ $linkUrl }}">
                <x-primary-button>
                    {{ $linkText }}
                </x-primary-button>
            </a>
            @endif
        </div>
        <div class="p-6 bg-border">
            {{ $slot }}
        </div>
    </div>
</div>