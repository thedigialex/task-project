<x-app-layout>
    @if(isset($company))
    <x-header :headerTitle="'Edit Company'"></x-header>
    @else
    <x-header :headerTitle="'Create Company'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($company) ? route('companies.update', ['companyId' => $company->id]) : route('companies.store') }}" class="w-full max-w-md mx-auto">
                    @csrf
                    @if(isset($company))
                    @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block  text-cyan-100 text-sm font-bold mb-2">Company Name:</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required value="{{ isset($company) ? $company->name : old('name') }}" />
                    </div>

                    <div class="flex justify-center">
                        <x-button type="submit">
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