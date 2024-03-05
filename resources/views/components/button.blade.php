<button {{ $attributes->merge(['class' => 'dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200 ring-1 ring-gray-200 hover:ring-gray-400']) }}>
    {{ $slot }}
</button>

