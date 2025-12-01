@php
    // Definisikan class yang akan diterapkan saat link aktif
    $activeClass = 'text-[#3652AD] font-bold underline underline-offset-4';
    // Definisikan class default
    $defaultClass = 'text-[#3652AD] ';
@endphp

<nav class="flex justify-between items-center px-6 py-2 bg-[#F8BD00] !fixed !top-0 !left-0 !w-full !z-50" style="position: fixed !important; top: 0 !important; left: 0 !important; z-index: 9999 !important;">
    <div class="logo flex items-center gap-3">
    <img src="{{ asset('images/Logo.png') }}" alt="Adopt a Buddy" class="mx-2 h-[100px]">
  </div>

    <ul class="nav-menu flex gap-6 font-semibold">
    {{-- HOME --}}
    <li>
        <a href="{{ route('dashboard') }}" 
           class="{{ Request::routeIs('dashboard') ? $activeClass : $defaultClass }}">
            Home
        </a>
    </li>
        
    {{-- PETS --}}
    <li>
        <a href="{{ route('hewan.index') }}" 
           class="{{ Request::routeIs('hewan.index') ? $activeClass : $defaultClass }}">
            Pets
        </a>
    </li>

    @if(Auth::check() && Auth::user()->role === 'user')
      {{-- ABOUT US --}}
      <li>
          <a href="{{ route('about') }}" 
             class="{{ Request::routeIs('about') ? $activeClass : $defaultClass }}">
              About Us
          </a>
      </li>
    @endif
        
        {{-- Menu Admin (tidak diubah, fokus pada menu user) --}}
    @if(Auth::check() && Auth::user()->role === 'admin')
      <li><a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? $activeClass : $defaultClass }}">Admin Dashboard</a></li>
      <li><a href="{{ route('admin.hewan.index') }}" class="{{ Request::routeIs('admin.hewan.index') ? $activeClass : $defaultClass }}">Manage Pets</a></li>
      <li><a href="{{ route('admin.adopsi.index') }}" class="{{ Request::routeIs('admin.adopsi.index') ? $activeClass : $defaultClass }}">Manage Adoption</a></li>
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
    <button @click="open = !open" class="flex items-center gap-2 font-semibold">
            {{-- Tambahkan class active pada nama user jika halaman profile aktif --}}
      <span class="{{ Request::routeIs('profile.edit') ? 'text-blue-600 font-bold' : '' }}">
                {{ Auth::user()->first_name ?? 'User' }}
            </span>
      <svg width="16" height="16" fill="currentColor" class="mt-1">
        <path d="M5 6l5 5 5-5z"/>
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