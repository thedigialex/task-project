<button {{ $attributes->merge([
    'class' => 'hover:text-text hover:bg-highlight_accent bg-accent text-header
               rounded px-4 py-2 text-lg transition-transform duration-300
               hover:scale-105'
]) }}>
    {{ $slot }}
</button>