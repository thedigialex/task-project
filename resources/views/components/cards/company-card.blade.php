@props(['company'])

<form action="{{ route('companies.show') }}" method="POST" class="w-full md:w-1/3 lg:w-1/4 xl:w-1/4 p-2" >
    @csrf
    <input type="hidden" name="company_id" value="{{ $company->id }}">
    <div class="shadow-lg p-6 rounded-md bg-header flex flex-col justify-between items-center">

        <!-- Title at the top, centered -->
        <div class="text-center mb-4 w-full">
            <x-fonts.highlight-header>{{ $company->truncateName() }}</x-fonts.highlight-header>
            <hr class="border-t-2 border-accent">
        </div>

        <div class="flex flex-col items-center">
            <div class="mb-4">
                <i class="fas fa-building text-4xl text-text"></i>
            </div>
            <div>
                <x-primary-button type="submit">Company</x-primary-button>
            </div>
        </div>
    </div>
</form>
