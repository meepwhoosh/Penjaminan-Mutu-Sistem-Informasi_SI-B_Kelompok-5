@extends('layouts.app') {{-- Pastikan ini sesuai dengan nama file layout utama Anda --}}

@section('content')

<div class="container mx-auto px-6 py-10 max-w-5xl font-sans mt-24">
    
    {{-- Flash Message (Jika ada update data) --}}
    @if (session('status') === 'profile-updated')
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
             class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ __('Profile saved successfully.') }}</span>
        </div>
    @endif

    {{-- Judul Halaman --}}
    <h1 class="text-[#3654a5] text-4xl font-bold mb-8">Profile</h1>

    {{-- Kita bungkus dalam form agar nanti bisa dikembangkan jadi fitur Update --}}
    <form method="post" action="{{ route('profile.update') }}" class="w-full">
        @csrf
        @method('patch')

        {{-- Bagian Foto Profil & Email --}}
        <div class="flex flex-col items-center justify-center mb-12 relative">
            <div class="relative group cursor-pointer">
                {{-- Foto Profil Bulat --}}
                <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-gray-100 shadow-sm">
                    {{-- Menggunakan UI Avatars yang dinamis berdasarkan Nama User --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=256" 
                         alt="{{ $user->name }}" 
                         class="w-full h-full object-cover">
                </div>
                
                {{-- Tombol Edit (Hanya hiasan visual/trigger modal jika dikembangkan) --}}
                <button type="button" class="absolute bottom-2 right-2 bg-white text-[#3654a5] rounded-full p-2.5 shadow-md border border-gray-200 hover:bg-gray-50 transition transform hover:scale-105">
                    <i class="fa-solid fa-pencil w-4 h-4 flex items-center justify-center"></i>
                </button>
            </div>
            
            {{-- Email User (Dinamis dari Database) --}}
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

            {{-- Address --}}
            {{-- Catatan: Pastikan kolom 'address' ada di tabel users, atau kode ini akan menampilkan '-' --}}
            <div>
                <label for="address" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Address</label>
                <input type="text" id="address" name="address" 
                    value="{{ old('address', $user->address ?? '-') }}" 
                    class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors">
            </div>

            {{-- Phone Number --}}
            <div>
                <label for="phone" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Phone Number</label>
                <input type="text" id="phone" name="phone" 
                    value="{{ old('phone', $user->phone ?? '-') }}" 
                    class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors">
            </div>

            {{-- Date of Birth --}}
            <div>
                <label for="birth_date" class="block text-[#facc15] font-bold text-lg mb-2 pl-2">Date of Birth</label>
                <input type="text" id="birth_date" name="birth_date" 
                    value="{{ old('birth_date', $user->birth_date ?? '-') }}" 
                    placeholder="DD/MM/YYYY"
                    class="w-full border border-[#8da2fb] rounded-full px-6 py-3 text-gray-600 outline-none bg-white focus:border-[#3654a5] focus:ring-1 focus:ring-[#3654a5] transition-colors">
            </div>
        </div>

        {{-- Tombol Save (Opsional, aktifkan jika ingin form ini berfungsi untuk update) --}}
        <div class="flex justify-end mb-12">
            <button type="submit" class="bg-[#3654a5] text-white font-bold py-2 px-8 rounded-full hover:bg-blue-800 transition shadow-lg">
                Update Profile
            </button>
        </div>

    </form>

    {{-- Bagian Adoption Status --}}
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
                    {{-- Menggunakan relasi 'adopsi' yang sudah dimuat di Controller --}}
                    @forelse($user->adopsi as $adopsi)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="border-r border-[#facc15] p-4 text-[#3654a5] font-medium align-top">
                                {{-- Ambil nama hewan dari relasi di tabel 'hewan' (jika ada) --}}
                                {{-- Hapus fallback, karena relasi 'hewan' sudah pasti dimuat --}}
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