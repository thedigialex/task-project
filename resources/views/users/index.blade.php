<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl">{{ __('Users') }}</h2>
                    <div class="flex flex-wrap gap-5">
                        @foreach ($users as $user)
                        <x-user-card :name="$user->name" :email="$user->email" :editUrl="route('users.edit', ['userId' => $user->id])">
                        </x-user-card>
                        @endforeach
                    </div>
                    <div class="flex justify-center pt-4">
                        <x-button>
                            <a href="{{ route('users.create') }}">{{ __('New User') }}</a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
