@props(['active', 'href'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 font-semibold text-cyan-100 hover:text-cyan-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500'
            : 'inline-flex items-center px-1 pt-1 font-semibold text-cyan-100 hover:text-cyan-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
