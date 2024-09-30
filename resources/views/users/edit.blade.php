<x-app-layout>
    @if(isset($user))
    <x-header :headerTitle="'Edit User'"></x-header>
    @else
    <x-header :headerTitle="'Create User'"></x-header>
    @endif
    <x-container :title="'User'">
        <div class="flex flex-wrap gap-5 justify-center my-8">
            <form method="POST" action="{{ route('users.update') }}" class="w-full lg:w-1/2 mx-auto bg-header p-4 rounded-md">
                @csrf
                @if(isset($user))
                <input type="hidden" name="id" value="{{ $user->id }}">
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

                @if($isAdmin)
                <!-- Role -->
                <div class="mb-4">
                    <x-input-label for="user_type" :value="__('Role')" />
                    <select name="user_type" id="user_type" class="block mt-1 w-full bg-body rounded-md border-border shadow-sm focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="admin" {{ old('user_type', isset($user) && $user->user_type === 'admin' ? 'selected' : '') }}>Admin</option>
                        <option value="client" {{ old('user_type', isset($user) && $user->user_type === 'client' ? 'selected' : '') }}>Client</option>
                        <option value="manager" {{ old('user_type', isset($user) && $user->user_type === 'manager' ? 'selected' : '') }}>Manager</option>
                    </select>
                </div>

                <!-- Company -->
                <div class="mb-4" id="companyDropdown">
                    <x-input-label for="company_id" :value="__('Company')" />
                    <select name="company_id" id="company_id" class="block mt-1 w-full bg-body rounded-md border-border shadow-sm focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="">N/A</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id', isset($user) && $user->company_id == $company->id ? 'selected' : '') }}>{{ $company->name }}</option>
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