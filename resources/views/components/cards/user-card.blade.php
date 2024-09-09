@props(['user'])

<form action="{{ route('users.edit') }}" method="POST" class="w-full md:w-1/3 lg:w-1/4 xl:w-1/4 p-2" >
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="shadow-lg p-6 rounded-md bg-header h-[228px] flex flex-col justify-between">

        <!-- Title at the top, centered -->
        <div class="text-center mb-4">
            <x-fonts.highlight-header>{{ $user->name }}</x-fonts.highlight-header>
            <hr class="border-t-2 border-accent">
        </div>

        <div class="flex items-center">
            <div class="mr-4 relative">
                <i class="fas fa-user text-4xl text-text"></i>
            </div>
            <div>
                <x-fonts.paragraph><a href="mailto:{{ $user->email }}" class="text-text hover:text-accent">{{ $user->email }}</a>
                </x-fonts.paragraph>
            </div>
        </div>

        <!-- Button at the bottom -->
        <div class="text-center mt-auto">
            <x-primary-button type="submit">Edit User</x-primary-button>
        </div>
    </div>
</form>