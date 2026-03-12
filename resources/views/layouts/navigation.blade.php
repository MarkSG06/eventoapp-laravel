@php
$navLinks = [
['route' => 'dashboard', 'label' => 'Dashboard'],
['route' => 'users', 'label' => 'Usuarios'],
['route' => 'customers', 'label' => 'Clientes'],
['route' => 'tickets', 'label' => 'Tickets'],
];
@endphp
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex gap-4">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
                <style>
                    #menu__toggle {
                        opacity: 0;
                    }

                    #menu__toggle:checked~.menu__btn>span {
                        transform: rotate(45deg);
                    }

                    #menu__toggle:checked~.menu__btn>span::before {
                        top: 0;
                        transform: rotate(0);
                    }

                    #menu__toggle:checked~.menu__btn>span::after {
                        top: 0;
                        transform: rotate(90deg);
                    }

                    #menu__toggle:checked~.menu__box {
                        visibility: visible;
                        left: 0;
                    }

                    .menu__btn {
                        display: flex;
                        align-items: center;
                        position: fixed;
                        width: 26px;
                        height: 26px;
                        cursor: pointer;
                        z-index: 1000;
                    }

                    .menu__btn>span,
                    .menu__btn>span::before,
                    .menu__btn>span::after {
                        display: block;
                        position: absolute;

                        width: 100%;
                        height: 2px;

                        background-color: #616161;

                        transition-duration: .25s;
                    }

                    .menu__btn>span::before {
                        content: '';
                        top: -8px;
                    }

                    .menu__btn>span::after {
                        content: '';
                        top: 8px;
                    }

                    .menu__box {
                        display: block;
                        position: fixed;
                        visibility: hidden;
                        top: 0;
                        left: -100%;
                        width: 300px;
                        height: 100%;
                        margin: 0;
                        padding: 80px 0;
                        list-style: none;
                        background-color: #fff;
                        box-shadow: 1px 0px 6px rgba(0, 0, 0, .2);
                        transition-duration: .25s;
                        z-index: 999;
                    }

                    .menu__item {
                        display: block;
                        padding: 12px 24px;

                        color: #333;

                        font-family: 'Roboto', sans-serif;
                        font-size: 20px;
                        font-weight: 600;

                        text-decoration: none;

                        transition-duration: .25s;
                    }

                    .menu__item:hover {
                        background-color: #CFD8DC;
                    }
                </style>
                {{-- Hamburguer --}}
                <div class="hamburger-menu">
                    <input id="menu__toggle" type="checkbox" />
                    <label class="menu__btn" for="menu__toggle">
                        <span></span>
                    </label>

                    <ul class="menu__box">
                        <div class="pt-2 pb-3 space-y-1">
                            @foreach ($navLinks as $link)
                            <x-responsive-nav-link :href="route($link['route'])"
                                :active="request()->routeIs($link['route'])">
                                {{ __($link['label']) }}
                            </x-responsive-nav-link>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($navLinks as $link)
            <x-responsive-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'])">
                {{ __($link['label']) }}
            </x-responsive-nav-link>
            @endforeach
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>