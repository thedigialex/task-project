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

<body class="antialiased">

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center  bg-slate-900 selection:bg-red-500">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            @if(auth()->user()->user_type == 'staff')
            <a href="{{ route('companies.index') }}" class="font-semibold text-cyan-100 hover:text-cyan-400  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Go to Companies') }}</a>
            @elseif(auth()->user()->company)
            <x-nav-link :href="route('companies.show')" :active="request()->routeIs('companies.show')">
                {{ __('Company') }}
            </x-nav-link>
            @else
            <span class="text-cyan-100 hover:text-cyan-400">{{ __('Awaiting Company Registration') }}</span>
            @endif
            @else
            <a href="{{ route('login') }}" class="font-semibold text-cyan-100 hover:text-cyan-400  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Log in') }}</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-cyan-100 hover:text-cyan-400  focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Register') }}</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="container mx-auto text-center py-10">
            <h1 class="text-cyan-400 text-4xl font-bold mb-4">Welcome To</h1>
            <div class="flex justify-center items-center">
                <x-application-logo class="fill-current" width="400" height="400" />
            </div>

            <div class="bg-slate-800 p-6 rounded-lg shadow-lg text-left text-cyan-400">
                <h2 class="text-2xl font-semibold mb-3">Overview</h2>
                <p class="text-cyan-100">This system facilitates the management of project tasks while providing outside clients access to their respective projects.</p>

                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Features</h3>
                    <ul>
                        <li class="text-cyan-100">User Authentication: Separate authentication systems for staff and clients.</li>
                        <li class="text-cyan-100">Project Management: Manage companies, projects, phases, and tasks.</li>
                        <li class="text-cyan-100">Bug Tracking: Log and track project-related bugs.</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h3 class="text-xl font-semibold">MVP Phase</h3>
                    <p class="text-cyan-100">Currently in Phase One of our Minimum Viable Product (MVP), focusing on core functionalities.</p>
                </div>
            </div>
        </div>

        <div class="stars-overlay"></div>

        <script>
            function createStars() {
                const starsOverlay = document.querySelector('.stars-overlay');
                for (let i = 0; i < 100; i++) {
                    const star = document.createElement('div');
                    star.classList.add('star');
                    star.style.top = `${Math.random() * 100}%`;
                    star.style.left = `${Math.random() * 100}%`;
                    star.style.animationDuration = `${Math.random() * 3 + 1}s`; // Random duration between 1s and 4s
                    starsOverlay.appendChild(star);
                }
            }

            createStars();
        </script>
</body>

</html>