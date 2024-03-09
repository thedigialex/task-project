<x-app-layout>
    @if(isset($user))
    <x-header :headerTitle="'Edit User'"></x-header>
    @else
    <x-header :headerTitle="'Create User'"></x-header>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form method="POST" action="{{ isset($user) ? route('users.update', ['userId' => $user->id]) : route('users.store') }}">
                    @csrf
                    @if(isset($user))
                    @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', isset($user) ? $user->email : '') }}" required>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @unless(isset($user))
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    @endunless
                    @if(auth()->user()->user_type == 'staff')
                    <div class="mb-3">
                        <label for="user_type" class="form-label">{{ __('Role') }}</label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="client" {{ old('role', isset($user) && $user->user_type === 'client' ? 'selected' : '') }}>Client</option>
                            <option value="staff" {{ old('role', isset($user) && $user->user_type === 'staff' ? 'selected' : '') }}>Staff</option>
                        </select>
                    </div>

                    <div class="mb-3" id="companyDropdown">
                        <label for="company" class="form-label">{{ __('Company') }}</label>
                        <select name="company_id" id="company_id" class="form-control">
                            <option value="">N/A</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company', isset($user) && $user->company_id == $company->id ? 'selected' : '') }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="flex justify-center pt-4">
                        <x-button>{{ isset($user) ? __('Update User') : __('Create User') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>