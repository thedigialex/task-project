@props([
    'title', 
    'linkUrl' => null, 
    'linkText' => '', 
    'formAction' => null,
    'hiddenInputName' => null,
    'hiddenInputValue' => null
])

<div class="py-4 px-0 md:px-8">
    <div class="border border-border shadow-sm sm:rounded-lg">
        <div class="p-4 flex justify-between items-center bg-header rounded-t h-20">
            <x-fonts.sub-header>{{ $title }}</x-fonts.sub-header>

            @if($linkUrl)
                <!-- If linkUrl is provided, show the hyperlink -->
                <a href="{{ $linkUrl }}">
                    <x-primary-button>
                        {{ $linkText }}
                    </x-primary-button>
                </a>
            @elseif($formAction)
                <!-- If formAction is provided, show the form -->
                <form method="POST" action="{{ $formAction }}">
                    @csrf
                    @if($hiddenInputName && $hiddenInputValue)
                        <input type="hidden" name="{{ $hiddenInputName }}" value="{{ $hiddenInputValue }}">
                    @endif
                    <x-primary-button>
                        {{ $linkText }}
                    </x-primary-button>
                </form>
            @endif
        </div>
        <div class="p-6 bg-border">
            {{ $slot }}
        </div>
    </div>
</div>
