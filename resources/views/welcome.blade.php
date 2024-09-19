<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artemis Trek</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased selection:bg-cyan-500 h-screen bg-body">
    <div class="h-full flex flex-col lg:flex-row  justify-center">
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-2 lg:p-32">
            <div class="bg-border p-2 lg:p-6 rounded-t  justify-center">
                <div id="form-container" class="w-full ">
                    <div id="login-form" class="form block">
                        @include('auth.login')
                    </div>
                    <div id="register-form" class="form hidden">
                        @include('auth.register')
                    </div>
                    <div id="forgot-form" class="form hidden">
                        @include('auth.forgot-password')
                    </div>
                </div>
                <div class="flex justify-center space-x-4 pt-8">
                    <x-primary-button id="toggle-button" onclick="toggleForms()" class="w-64">Register</x-primary-button>
                    <x-primary-button onclick="showForm('forgot-form')" class="w-64">Forgot Password?</x-primary-button>
                </div>
            </div>
            <div class="rounded-b bg-header w-full py-2 px-4 text-center rounded-b-md shadow-md hidden sm:block">
                <x-fonts.paragraph>&copy; TheDigiAlex 2024</x-fonts.paragraph>
            </div>
        </div>
        <div class="stars-overlay "></div>
        <div class="hidden lg:flex flex-col lg:w-1/2 bg-header items-center justify-center">
            <x-application-logo class="fill-current" width="400" height="400" />
        </div>
    </div>
    <script>
        function toggleForms() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const toggleButton = document.getElementById('toggle-button');
            document.getElementById('forgot-form').classList.add('hidden');

            if (loginForm.classList.contains('hidden')) {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                toggleButton.textContent = 'Register';
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                toggleButton.textContent = 'Login';
            }
        }

        function showForm(formId) {
            const forms = document.querySelectorAll('.form');
            forms.forEach(form => form.classList.add('hidden'));

            const selectedForm = document.getElementById(formId);
            selectedForm.classList.remove('hidden');
        }
    </script>

</body>

</html>