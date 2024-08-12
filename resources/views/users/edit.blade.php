<x-app-layout>
    @if(isset($user))
    <x-header :headerTitle="'Edit User'"></x-header>
    @else
    <x-header :headerTitle="'Create User'"></x-header>
    @endif
    <x-container :title="'User'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form method="POST" action="{{ isset($user) ? route('users.update', ['userId' => $user->id]) : route('users.store') }}" class="w-full max-w-md mx-auto">
                @csrf
                @if(isset($user))
                @method('PUT')
                @endif

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($user) ? $user->name : '')" required />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', isset($user) ? $user->email : '')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                @unless(isset($user))
                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>
                @endunless

                @if(auth()->user()->user_type == 'staff')
                <!-- Role -->
                <div class="mb-4">
                    <x-input-label for="user_type" :value="__('Role')" />
                    <select name="user_type" id="user_type" class="block mt-1 w-full rounded-md border-border shadow-sm">
                        <option value="client" {{ old('role', isset($user) && $user->user_type === 'client' ? 'selected' : '') }}>Client</option>
                        <option value="staff" {{ old('role', isset($user) && $user->user_type === 'staff' ? 'selected' : '') }}>Staff</option>
                    </select>
                </div>

                <!-- Company -->
                <div class="mb-4" id="companyDropdown">
                    <x-input-label for="company_id" :value="__('Company')" />
                    <select name="company_id" id="company_id" class="block mt-1 w-full rounded-md border-border shadow-sm">
                        <option value="">N/A</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company', isset($user) && $user->company_id == $company->id ? 'selected' : '') }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <br>
                <!-- Submit Button -->
                <div class="flex justify-center">
                    <x-primary-button>
                        {{ isset($user) ? __('Update User') : __('Create User') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-container>
</x-app-layout>