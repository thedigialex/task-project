<x-app-layout>
    <x-header :headerTitle="'Profile'"></x-header>
    <x-container :title="'Profile'">
        
        <div class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md my-4">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md my-4">
            @include('profile.partials.update-password-form')
        </div>
        <div class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md my-4">
            @include('profile.partials.delete-user-form')
        </div>
    </x-container>
</x-app-layout>