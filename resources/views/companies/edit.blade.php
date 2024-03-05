<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(isset($company))
                {{ __('Edit Company') }}
            @else
                {{ __('Create Company') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($company) ? route('companies.update', ['company' => $company->id]) : route('companies.store') }}">
                    @csrf
                    @if(isset($company))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Company Name:</label>
                        <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" required value="{{ isset($company) ? $company->name : old('name') }}" />
                    </div>
                    <div>
                        <x-button>
                        @if(isset($company))
                                {{ __('Update') }}
                            @else
                                {{ __('Create') }}
                            @endif
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
