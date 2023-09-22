<div class="flex space-x-5">

    
    <x-nav-link href="{{ route('login')}}" :active="request()->routeIs('login')">
        Login
    </x-nav-link>
    <x-nav-link href="{{ route('register')}}" :active="request()->routeIs('register')">
        Register
    </x-nav-link>


</div>
