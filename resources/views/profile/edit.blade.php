<x-app-layout>
    <x-header :headerTitle="'Profile'"></x-header>
    <x-container :title="'Profile'">
        
        <div class="w-full max-w-md mx-auto bg-body p-4 rounded-md bg-body mb-8">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="w-full max-w-md mx-auto bg-body p-4 rounded-md bg-body mb-8">
            @include('profile.partials.update-password-form')
        </div>
        <div class="w-full max-w-md mx-auto bg-body p-4 rounded-md bg-body mb-8">
            @include('profile.partials.delete-user-form')
        </div>
    </x-container>
</x-app-layout>