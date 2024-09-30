@props(['bug'])

<form action="{{ route('bugs.edit') }}" method="POST" class="w-full md:w-1/4 p-2">
    @csrf
    <input type="hidden" name="bug_id" value="{{ $bug->id }}">
    <div class="shadow-lg p-6 rounded-md bg-header flex flex-col justify-between items-center">

        <div class="text-center mb-4 w-full">
            <x-fonts.highlight-header>{{ $bug->truncateName() }}</x-fonts.highlight-header>
            <hr class="border-t-2 border-accent">
        </div>

        <div class="flex flex-col items-center">
            <div class="mb-4">
                <i class="fas fa-sitemap text-4xl text-text"></i>
            </div>
            <div>
                <x-primary-button type="submit">View bug</x-primary-button>
            </div>
        </div>
    </div>
</form>