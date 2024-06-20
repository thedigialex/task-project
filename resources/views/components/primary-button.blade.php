<button {{ $attributes->merge([
    'class' => 'hover:text-slate-700 hover:bg-cyan-400 bg-slate-700 text-cyan-400
               rounded px-4 py-2 text-lg transition-transform duration-300
               hover:scale-105'
]) }}>
    {{ $slot }}
</button>