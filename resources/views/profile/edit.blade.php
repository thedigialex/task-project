<x-app-layout>
    <x-header :headerTitle="'Profile'"></x-header>
    <x-container :title="'Profile'">
        @if($showWarning)
        <div class="alert alert-warning w-full lg:w-1/2 mx-auto bg-header border-l-4 border-yellow-500 p-4 mb-4" role="alert">
            <x-fonts.sub-header class="font-bold">Notice</x-fonts.sub-header>
            <x-fonts.paragraph>Awaiting company assignment.</x-fonts.paragraph>
        </div>
        @endif

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