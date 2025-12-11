@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-10 max-w-5xl font-sans mt-24">
    
    {{-- Flash Message --}}
    @if (session('status') === 'profile-updated')
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
             class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ __('Profile saved successfully.') }}</span>
        </div>
    @endif

    <h1 class="text-[#3654a5] text-4xl font-bold mb-8">Profile</h1>

    <form method="post" action="{{ route('profile.update') }}" class="w-full">
        @csrf
        @method('patch')

        {{-- Bagian Foto Profil & Email --}}
        <div class="flex flex-col items-center justify-center mb-12 relative">
            <div class="relative group cursor-pointer">
                <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-gray-100 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=256" 
                         alt="{{ $user->name }}" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            <p class="text-[#3654a5] mt-4 text-lg font-medium">
                {{ $user->email }}
            </p>
        </div>

        {{-- Form Biodata --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-16">
            
            {{-- Name --}}
            <div>
                <label for="name" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Name</label>
                <input type="text" id="name" name="name" 
                    value="{{ old('name', $user->first_name) }}" 
                    class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors" required>
                @error('name') <span class="text-red-500 text-sm pl-4">{{ $message }}</span> @enderror
            </div>

    {{-- Alamat --}}
    <div>
        <label for="alamat" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Address</label>
        {{-- Menggunakan input text biasa --}}
        <input type="text" id="alamat" name="alamat" 
            {{-- DATA STATIS MUNCUL DISINI --}}
            value="{{ old('alamat', $user->alamat) }}" 
            placeholder="Masukkan alamat lengkap"
            class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors">
            @error('alamat') <span class="text-red-500 text-sm pl-4">{{ $message }}</span> @enderror
    </div>

    {{-- Nomor HP --}}
    <div>
        <label for="nomor_hp" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Phone Number</label>
        <input type="text" id="nomor_hp" name="nomor_hp" 
            {{-- DATA STATIS MUNCUL DISINI --}}
            value="{{ old('nomor_hp', $user->nomor_hp) }}" 
            placeholder="08xxxxxxxxxx"
            class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors">
        @error('nomor_hp') <span class="text-red-500 text-sm pl-4">{{ $message }}</span> @enderror
    </div>

    {{-- Tanggal Lahir --}}
    <div>
        <label for="tanggal_lahir" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Date of Birth</label>
        {{-- Kita perlu format tanggalnya jadi YYYY-MM-DD agar terbaca oleh input type="date" --}}
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" 
            {{-- DATA STATIS MUNCUL DISINI (Diformat dulu) --}}
            value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}" 
            class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors">
        @error('tanggal_lahir') <span class="text-red-500 text-sm pl-4">{{ $message }}</span> @enderror
    </div>
</div>
        </div>

        <div class="flex justify-end mb-12">
            <button type="submit" class="bg-[#3654a5] text-white font-bold py-2 px-8 rounded-full hover:bg-blue-800 transition shadow-lg">
                Update Profile
            </button>
        </div>
    </form>

    {{-- Bagian Adoption Status (Sudah Benar) --}}
    <div class="mb-12">
        <h2 class="text-[#3654a5] text-2xl font-bold mb-6 flex items-center gap-2">
            <i class="fa-solid fa-paw"></i> Adoption Status
        </h2>
        <div class="overflow-hidden rounded-lg border border-[#facc15]">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border-b border-r border-[#facc15] p-4 text-[#3654a5] font-bold bg-white text-left w-1/4">Nama Hewan</th>
                        <th class="border-b border-r border-[#facc15] p-4 text-[#3654a5] font-bold bg-white text-left w-1/4">Tanggal Pengajuan</th>
                        <th class="border-b border-r border-[#facc15] p-4 text-[#3654a5] font-bold bg-white text-left w-1/4">Status</th>
                        <th class="border-b border-[#facc15] p-4 text-[#3654a5] font-bold bg-white text-left w-1/4">Tanggal Adopsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->adopsi as $adopsi)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="border-r border-[#facc15] p-4 text-[#3654a5] font-medium align-top">
                                {{ $adopsi->hewan->nama }}
                            </td>
                            <td class="border-r border-[#facc15] p-4 text-[#3654a5] font-medium align-top">
                                {{ $adopsi->created_at?->format('d M Y') }} 
                            </td>
                            <td class="border-r border-[#facc15] p-4 text-[#3654a5] font-medium align-top">
                                {{ ucwords($adopsi->status) }}
                            </td>
                            <td class="p-4 text-[#3654a5] font-medium align-top">
                                {{ $adopsi->tanggal_adopsi?->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4" class="p-4 text-gray-500">Anda belum memiliki riwayat adopsi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection