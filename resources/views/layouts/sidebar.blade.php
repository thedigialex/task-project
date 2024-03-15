<div>
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
        <div x-data="{ open: false }" class="relative lg:hidden">
            <div class="sticky top-0  flex items-center gap-x-6 bg-slate-900 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="open = true">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
                <a href="{{ route('profile.edit') }}">
                    <span class="sr-only">Profile</span>
                    <i class="text-cyan-400 fa fa-user" aria-hidden="true"></i>
                </a>
            </div>
            <div class="fixed inset-0 bg-gray-900/80" x-show="open"></div>
            <div class="fixed inset-0 flex" x-show="open">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6 pb-2">
                        <div class="flex h-16 shrink-0 items-center">
                            <x-application-logo />
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7 mx-2 space-y-1">
                                <li>
                                    <ul>
                                        @if(auth()->user()->user_type == 'client')
                                        <li>
                                            <a href="{{ route('companies.show') }}" class="{{ request()->is('*compan*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 {{ request()->is('*compan*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                                </svg>
                                                Company
                                            </a>
                                        </li>
                                        @else
                                        <li>
                                            <a href="{{ route('companies.index') }}" class="{{ request()->is('*compan*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 {{ request()->is('*compan*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                                </svg>
                                                Companies
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('projects.index') }}" class="{{ request()->is('*project*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 {{ request()->is('*project*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                </svg>
                                                Projects
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tasks.index') }}" class="{{ request()->is('*task*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }}  hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 {{ request()->is('*task*') ? 'text-cyan-400' : 'text-cyan-100' }}  group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                                </svg>
                                                Tasks
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('users.index') }}" class="{{ request()->is('*user*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 {{ request()->is('*user*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>
                                                Users
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6">
            <div class="flex h-16 items-center justify-between">
                <x-application-logo />
                <div class="flex items-center">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-cyan-400 bg-slate-900 dark:bg-gray-800 hover:text-cyan-400 focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7 mx-2 space-y-1">
                    <li>
                        <ul>
                            @if(auth()->user()->user_type == 'client')
                            <li>
                                <a href="{{ route('companies.show') }}" class="{{ request()->is('*compan*') ? 'bg-slate-700  text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <svg class="h-6 w-6 {{ request()->is('*compan*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    Company
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('companies.index') }}" class="{{ request()->is('*compan*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <svg class="h-6 w-6 {{ request()->is('*compan*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    Companies
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('projects.index') }}" class="{{ request()->is('*project*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <svg class="h-6 w-6 {{ request()->is('*project*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                    </svg>
                                    Projects
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tasks.index') }}" class="{{ request()->is('*task*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }}  hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <svg class="h-6 w-6 {{ request()->is('*task*') ? 'text-cyan-400' : 'text-cyan-100' }}  group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                    </svg>
                                    Tasks
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}" class="{{ request()->is('*user*') ? 'bg-slate-700 text-cyan-400' : 'text-cyan-100' }} hover:bg-slate-700 hover:text-cyan-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <svg class="h-6 w-6 {{ request()->is('*user*') ? 'text-cyan-400' : 'text-cyan-100' }} group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                    Users
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <main class="lg:pl-72">
        @if (isset($header))
        <header class="bg-slate-900 dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif
        {{ $slot }}
    </main>
</div>
