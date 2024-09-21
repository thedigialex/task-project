@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
'class' => 'bg-body w-full rounded-md shadow-sm focus:ring-2 focus:ring-accent focus:border-accent'
]) !!}
>