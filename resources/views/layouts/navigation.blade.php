<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Search -->
                <x-search-form />

                <!-- Navigation links -->
                <div class="hidden space-x-8 sm:flex">
                    <!-- Insert language switch here -->
                    @include('language-switch')

                    <!-- Display alerts -->
                    <div>
                        @if(session('success'))
                            <script>
                                alert('{{ session('success') }}');
                            </script>
                        @endif

                        @if(session('error'))
                            <script>
                                alert('{{ session('error') }}');
                            </script>
                        @endif

                        @if(session('delayRedirect'))
                            <script>
                                setTimeout(function(){
                                    window.location = '{{ url()->previous() }}';
                                }, 1);
                            </script>
                        @endif
                    </div>

                    <!-- All Posts -->
                    <x-nav-link href="{{ route('posts.allposts') }}">
                        <p>{{__('messages.all_posts')}}</p>
                    </x-nav-link>

                    <!-- Create Post -->
                    <x-nav-link href="{{ route('posts.create') }}">
                        {{ __('messages.create_post') }}
                    </x-nav-link>

                    <!-- My Posts -->
                    <x-nav-link href="{{ route('posts.index') }}">
                        {{ __('messages.my_posts') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Display user balance -->
            <div style="position: relative; left: 33%; top: 29%; color: white;">Balance {{ Auth::user()->balance }}$</div>
            <div style="position: relative; right: 80%; top: 29%; color: white;">Cart</div>

            <!-- User dropdown menu -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown>
                    <x-slot name="trigger">
                        <!-- User avatar and email -->
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div><img src="/{{ Auth::user()->avatar }}" alt="Avatar" style="width: 35px; height: 35px; border-radius: 50%;"></div>
                            <div>{{ Auth::user()->email }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('messages.profile') }}
                        </x-dropdown-link>

                        <!-- My Posts -->
                        <x-dropdown-link :href="route('posts.index')">
                            {{ __('messages.my_posts') }}
                        </x-dropdown-link>

                        <!-- All Posts -->
                        <x-dropdown-link :href="route('posts.allposts')">
                            {{ __('messages.all_posts') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('messages.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Responsive menu button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <!-- Responsive menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Profile information -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('messages.dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- User information -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <!-- User actions -->
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('messages.profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('messages.logout') }}
                    </x-responsive-nav-link>
                </form>
        </div>
    </div>
</nav>

</body>
</html>
