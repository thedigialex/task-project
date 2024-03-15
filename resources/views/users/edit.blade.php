<x-app-layout>
    @if(isset($user))
    <x-header :headerTitle="'Edit User'"></x-header>
    @else
    <x-header :headerTitle="'Create User'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($user) ? route('users.update', ['userId' => $user->id]) : route('users.store') }}" class="w-full max-w-md mx-auto">
                    @csrf
                    @if(isset($user))
                    @method('PUT')
                    @endif
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-cyan-100">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-cyan-100">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50 @error('email') border-red-500 @enderror" value="{{ old('email', isset($user) ? $user->email : '') }}" required>

                        @error('email')
                        <span class="text-red-500 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @unless(isset($user))
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-cyan-100">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50 @error('password') border-red-500 @enderror" required>

                        @error('password')
                        <span class="text-red-500 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-cyan-100">{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50" required>
                    </div>
                    @endunless

                    @if(auth()->user()->user_type == 'staff')
                    <div class="mb-4">
                        <label for="user_type" class="block text-sm font-medium text-cyan-100">{{ __('Role') }}</label>
                        <select name="user_type" id="user_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50">
                            <option value="client" {{ old('role', isset($user) && $user->user_type === 'client' ? 'selected' : '') }}>Client</option>
                            <option value="staff" {{ old('role', isset($user) && $user->user_type === 'staff' ? 'selected' : '') }}>Staff</option>
                        </select>
                    </div>

                    <div class="mb-4" id="companyDropdown">
                        <label for="company_id" class="block text-sm font-medium text-cyan-100">{{ __('Company') }}</label>
                        <select name="company_id" id="company_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-100 focus:ring-opacity-50">
                            <option value="">N/A</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company', isset($user) && $user->company_id == $company->id ? 'selected' : '') }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="flex justify-center">
                        <x-button type="submit" >
                            {{ isset($user) ? __('Update User') : __('Create User') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
