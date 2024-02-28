<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul>
                        @foreach ($companies as $company)
                            <li>
                                <a href="{{ route('companies.admin', ['company' => $company->id]) }}">
                                    {{ $company->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-center">
                        <a href="{{ route('companies.create') }}"
                            class="dark:text-black bg-gray-200 hover:bg-gray-400 hover:text-white shadow shadow-gray-200 hover:shadow-gray-400 p-1 rounded transition ease-in-out duration-200">{{ __('Create New Company') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
