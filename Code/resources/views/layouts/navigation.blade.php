@php
    $activeClass = 'text-[#3652AD] font-bold underline underline-offset-4';
    $defaultClass = 'text-[#3652AD] ';
@endphp

<nav class="flex justify-between items-center px-6 py-2 bg-[#F8BD00] !fixed !top-0 !left-0 !w-full !z-50" style="position: fixed !important; top: 0 !important; left: 0 !important; z-index: 9999 !important;">
    <div class="logo flex items-center gap-3">
        <img src="{{ asset('images/Logo.png') }}" alt="Adopt a Buddy" class="mx-2 h-[70px] md:h-[80px]">
        @if(Auth::check() && Auth::user()->role === 'admin')
            <span class="px-3 py-1 rounded-full bg-blue-700 text-white text-sm font-semibold">Admin</span>
        @endif
    </div>

    <ul class="nav-menu flex gap-6 font-semibold">
        @if(Auth::check() && Auth::user()->role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ Request::routeIs('admin.dashboard') ? $activeClass : $defaultClass }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.hewan.index') }}"
                   class="{{ Request::routeIs('admin.hewan.index') ? $activeClass : $defaultClass }}">
                    Manage Pets
                </a>
            </li>
            <li>
                <a href="{{ route('admin.adopsi.index') }}"
                   class="{{ Request::routeIs('admin.adopsi.index') ? $activeClass : $defaultClass }}">
                    Manage Adoption
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="{{ Request::routeIs('dashboard') ? $activeClass : $defaultClass }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('hewan.index') }}" 
                   class="{{ Request::routeIs('hewan.index') ? $activeClass : $defaultClass }}">
                    Pets
                </a>
            </li>
            @if(Auth::check() && Auth::user()->role === 'user')
            <li>
                <a href="{{ route('about') }}" 
                   class="{{ Request::routeIs('about') ? $activeClass : $defaultClass }}">
                    About Us
                </a>
            </li>
            @endif
        @endif
    </ul>

    @guest
    <a href="{{ route('login') }}" class="login-btn flex items-center gap-2 px-4 py-2 bg-blue-500 rounded text-white">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
           d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
      </svg>
      Login
    </a>
  @endguest

  @auth
  <div x-data="{ open: false }" class="relative">
    <button @click="open = !open" aria-label="Pengaturan"
      class="flex items-center gap-2 font-semibold rounded-full px-3 py-2 text-blue-800 hover:bg-white/30 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition"
           viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09A1.65 1.65 0 0 0 10 3.09V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51h.09a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
      </svg>
      <svg width="12" height="12" fill="currentColor" class="text-blue-800 transition"
        :class="{ 'rotate-180': open }">
        <path d="M4 5l4 4 4-4z"/>
      </svg>
    </button>

        <div
      x-show="open"
      @click.outside="open = false"
      class="absolute right-0 mt-2 w-40 bg-white shadow rounded py-1 z-50"
      style="display: none;"
    >
      <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
      </form>
    </div>
  </div>
@endauth
</nav>
