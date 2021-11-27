<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed w-full top-0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('questions.index') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('questions.index') }}"
                        :active="request()->routeIs('questions.index')">
                        {{ __('急募') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('questions.new') }}" :active="request()->routeIs('questions.new')">
                        {{ __('新着') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('questions.popular') }}"
                        :active="request()->routeIs('questions.popular')">
                        {{ __('人気') }}
                    </x-jet-nav-link>
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if (Auth::check() == true)
                    <div class="flex items-center">
                        <a href="{{ route('purchase') }}" class="block flex items-center">
                            <div class="w-4 h-4">
                                <img src="https://illust8.com/wp-content/uploads/2018/11/gold-coin_illust_2205.png"
                                    alt="" class="w-full h-full object-contain block">
                            </div>
                            <p class="block ml-2">{{ Auth::user()->coin }}</p>
                        </a>
                        <a href="{{ route('questions.create') }}" class="bg-green-300 rounded p-2 block ml-4">質問する</a>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-base border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>

                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-sm text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('giftcard') }}">
                                    {{ __('ギフトカード') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'">
                        {{ __('Log in') }}
                    </a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                @if (Auth::check())
                    <div class="flex items-center">
                        <a href="{{ route('purchase') }}" class="block flex items-center">
                            <div class="w-4 h-4">
                                <img src="https://illust8.com/wp-content/uploads/2018/11/gold-coin_illust_2205.png"
                                    alt="" class="w-full h-full object-contain block">
                            </div>
                            <p class="block ml-2">{{ Auth::user()->coin }}</p>
                        </a>
                    </div>
                @endif
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @if (Auth::check())
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('questions.index') }}"
                    :active="request()->routeIs('questions.index')">
                    {{ __('急募の質問') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('questions.new') }}"
                    :active="request()->routeIs('questions.new')">
                    {{ __('新着の質問') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('questions.popular') }}"
                    :active="request()->routeIs('questions.popular')">
                    {{ __('人気の質問') }}
                </x-jet-responsive-nav-link>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('ログイン') }}
                </x-jet-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('新規登録') }}
                </x-jet-responsive-nav-link>
            </div>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::check())
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-base text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                        :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('giftcard') }}"
                        :active="request()->routeIs('giftcard')">
                        {{ __('ギフトカード') }}
                    </x-jet-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                            :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-jet-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            @endif
        </div>
    </div>
</nav>
