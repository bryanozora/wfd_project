<nav class="flex items-center sticky-top justify-between p-3 py-6 lg:px-8 bg-gray-700" aria-label="Global">
    <div class="flex lg:flex-1">
        <a href="{{ route('artist.home') }}" class="-m-1.5 p-1.5">
            <div class="container flex">
                <h1 class="font-rubik_mono_one text-3xl text-green-400 mx-6">Music Store</h1>
            </div>
        </a>
    </div>
    <div class="flex lg:hidden">
        <button type="button" id="menubutton" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
        <a href="{{ route('artist.home') }}" class="text-xl font-raleway font-bold leading-6 text-green-400 dark:text-gray-100">Album List</a>
        <a href="{{ route('artist.report') }}" class="text-xl font-raleway font-bold leading-6 text-green-400 dark:text-gray-100">Report</a>
        
    </div>
    <div class="lg:flex lg:flex-1 lg:justify-end">
        @guest
            <a href="/login" class="text-xl font-rubik_mono_one leading-6 text-green-400 dark:text-gray-100">Login</a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xl font-rubik_mono_one leading-6 text-green-400 dark:text-gray-100">Logout</button>
            </form>
        @endauth
    </div>
</nav>
