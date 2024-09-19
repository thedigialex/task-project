@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-text']) }}>
    {{ $value ?? $slot }}
</label>
