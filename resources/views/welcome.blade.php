<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArtemisTrek</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased selection:bg-cyan-500 h-screen bg-body">
    <div class="h-full flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-6 lg:p-32">
            <div class="bg-border p-4 lg:p-8 rounded">
                <div id="login-form" class="form-container active">
                    <x-sub-header>Sign In</x-sub-header>
                    <x-paragraph>Welcome! Please enter your details.</x-paragraph>
                    @include('auth.login')
                </div>
                <div id="register-form" class="form-container">
                    <x-sub-header>Sign Up</x-sub-header>
                    <x-paragraph>Welcome! Please enter your details.</x-paragraph>
                    @include('auth.register')
                </div>
                <div id="forgot-password-form" class="form-container">
                    <x-sub-header>Forgot your password?</x-sub-header>
                    <x-paragraph>Please enter your details.</x-paragraph>
                    @include('auth.forgot-password')
                </div>

                <div class="flex items-center justify-between mt-4 pt-4 border-t">
                    <x-secondary-button class="w-1/5 lg:w-1/4 h-10" onclick="showForm('login-form')">Login</x-secondary-button>
                    <x-secondary-button class="w-1/5 lg:w-1/4 h-10" onclick="showForm('register-form')">Register</x-secondary-button>
                    <x-secondary-button class="w-1/5 lg:w-1/4 h-10" onclick="showForm('forgot-password-form')">Forgot Password?</x-secondary-button>
                </div>
            </div>
        </div>
        <div class="stars-overlay"></div>
        <div class="hidden lg:flex flex-col lg:w-1/2 bg-header items-center justify-center">
            <x-application-logo class="fill-current" width="400" height="400" />
        </div>
    </div>
</body>

</html>