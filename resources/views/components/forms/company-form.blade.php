<x-container :title="'Company'">
    <div class="flex flex-wrap gap-5 justify-center my-8">
        <form method="POST" action="{{ isset($company) ? route('companies.update', ['companyId' => $company->id]) : route('companies.store') }}" class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md">
            @csrf
            @if(isset($company))
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            @method('PUT')
            @endif

            <!-- Company Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Company Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($company) ? $company->name : '')" required />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <x-primary-button>
                    {{ isset($company) ? __('Update Company') : __('Create Company') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-container>