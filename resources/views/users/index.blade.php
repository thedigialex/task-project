<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <ul>
                    @foreach($users as $user)
                    <li>
                        {{ $user->name }}
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Create New user</a>
            </div>
        </div>
    </div>
</x-app-layout>
