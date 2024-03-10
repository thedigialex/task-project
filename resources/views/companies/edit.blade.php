<x-app-layout>
    @if(isset($company))
    <x-header :headerTitle="'Edit Company'"></x-header>
    @else
    <x-header :headerTitle="'Create Company'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($company) ? route('companies.update', ['companyId' => $company->id]) : route('companies.store') }}">
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
