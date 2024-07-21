<nav id="navbar" class="nav-container">
    <!-- Primary Navigation Menu -->
    <!-- Navigation Links -->
    <x-page.nav-link :href="route('home')" class="nav-item" :active="request()->routeIs('home')">
        {{ __('Home') }}
    </x-page.nav-link>
    <x-page.nav-link :href="route('about')" class="nav-item" :active="request()->routeIs('about')">
        {{ __('About') }}
    </x-page.nav-link>
    <x-page.nav-link :href="route('news')" class="nav-item" :active="request()->routeis('news')">
        {{ __('News') }}
    </x-page.nav-link>
    <x-page.nav-link class="h-12 nav-item" :href="route('home')" :active="request()->routeIs('home')">
        <x-page.application-logo class="w-full h-full text-white fill-white"/>
    </x-page.nav-link>
    <x-page.nav-link :href="route('portfolio')" class="nav-item" :active="request()->routeIs('portfolio')">
        {{ __('Portfolio') }}
    </x-page.nav-link>
    <x-page.nav-link :href="route('discover')" class="nav-item" :active="request()->routeIs('discover')">
        {{ __('Discover') }}
    </x-page.nav-link>
    <x-page.nav-link :href="route('credits')" class="nav-item" :active="request()->routeIs('credits')">
        {{ __('Credits') }}
    </x-page.nav-link>
{{--    <x-page.nav-link :href="route('logout')" class="nav-item hidden"--}}
{{--                onclick="event.preventDefault(); this.closest('form').submit()">--}}
{{--        {{ __('Log Out') }}--}}
{{--    </x-page.nav-link>--}}

    <!-- Hamburger -->
    <div class="-me-2 flex items-center lg:hidden">
        <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</nav>
