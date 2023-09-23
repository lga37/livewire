<nav class="flex items-center justify-between py-3 px-6 border-b border-gray-100">
    <div id="nav-left" class="flex items-center">
        <x-authentication-card-logo />
        <div class="top-menu ml-10">
            <div class="flex space-x-4">


                <x-nav-link href="{{ route('home')}}" :active="request()->routeIs('home')">
                    Home
                </x-nav-link>

                <x-nav-link href="{{ route('posts.index')}}" :active="request()->routeIs('posts.index')">
                    Blog
                </x-nav-link>

                <x-nav-link href="{{ route('tasks')}}" :active="request()->routeIs('tasks')">
                    Tasks
                </x-nav-link>

                <x-nav-link href="{{ route('chat')}}" :active="request()->routeIs('chat')">
                    ChatGPT
                </x-nav-link>

                <x-nav-link href="/admin">
                    Admin
                </x-nav-link>


            </div>
        </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">

        @auth
            @include('layouts.partials.header-right-auth')
        @else
            @include('layouts.partials.header-right-guest')
        @endauth
    </div>
</nav>
