@extends('layouts.app')

@section('content')
<div class="w-full bg-gray-50 min-h-screen py-8 px-4 mt-20">
    
    {{-- Back Button --}}
    <div class="max-w-2xl mx-auto mb-6">
        <a href="{{ route('hewan.show', $hewan) }}" class="inline-flex items-center justify-center w-12 h-12 border-2 border-blue-700 rounded-lg hover:bg-blue-50 transition">
            <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
    </div>

    {{-- Form Container --}}
    <div class="max-w-2xl mx-auto bg-white rounded-3xl border-4 border-yellow-400 shadow-lg p-8">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900 flex items-center justify-center gap-2">
                <span class="text-2xl">🐾</span>
                Adoption Form
            </h1>
        </div>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('hewan.adopsi.request', $hewan) }}" method="POST" class="space-y-5">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
                <input type="text" 
                       name="nama_lengkap" 
                       placeholder="Nama lengkap" 
                       value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}"
                       class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition"
                       required>
            </div>

            {{-- Alamat Lengkap --}}
            <div>
                <input type="text" 
                       name="alamat" 
                       placeholder="Alamat lengkap" 
                       value="{{ old('alamat') }}"
                       class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition"
                       required>
            </div>

            {{-- Nomor Telepon/WhatsApp --}}
            <div>
                <input type="text" 
                       name="telepon" 
                       placeholder="Nomor telephone/Whatsapp" 
                       value="{{ old('telepon') }}"
                       class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition"
                       required>
            </div>

            {{-- Email --}}
            <div>
                <input type="email" 
                       name="email" 
                       placeholder="Email" 
                       value="{{ old('email', auth()->user()->email ?? '') }}"
                       class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition"
                       required>
            </div>

            {{-- Usia --}}
            <div>
                <input type="number" 
                       name="usia" 
                       placeholder="Usia" 
                       value="{{ old('usia') }}"
                       class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition"
                       required>
            </div>

            {{-- Pekerjaan --}}
            <div>
                <input type="text" 
                       name="pekerjaan" 
                       placeholder="Pekerjaan" 
                       value="{{ old('pekerjaan') }}"
                       class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition"
                       required>
            </div>

            {{-- Tipe Tempat Tinggal --}}
            <div>
                <select name="tipe_tempat_tinggal" 
                        class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition appearance-none bg-white"
                        required>
                    <option value="">Tipe tempat tinggal</option>
                    <option value="rumah" {{ old('tipe_tempat_tinggal') == 'rumah' ? 'selected' : '' }}>Rumah</option>
                    <option value="apartemen" {{ old('tipe_tempat_tinggal') == 'apartemen' ? 'selected' : '' }}>Apartemen</option>
                    <option value="kontrakan" {{ old('tipe_tempat_tinggal') == 'kontrakan' ? 'selected' : '' }}>Kontrakan</option>
                    <option value="kost" {{ old('tipe_tempat_tinggal') == 'kost' ? 'selected' : '' }}>Kost</option>
                </select>
            </div>

            {{-- Apakah pernah memelihara hewan sebelumnya --}}
            <div>
                <select name="pernah_pelihara" 
                        class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition appearance-none bg-white"
                        required>
                    <option value="">Apakah pernah memelihara hewan sebelumnya?</option>
                    <option value="ya" {{ old('pernah_pelihara') == 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ old('pernah_pelihara') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            {{-- Apakah saat ini memiliki hewan peliharaan lain --}}
            <div>
                <select name="punya_hewan_lain" 
                        class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 transition appearance-none bg-white"
                        required>
                    <option value="">Apakah saat ini memiliki hewan peliharaan lain?</option>
                    <option value="ya" {{ old('punya_hewan_lain') == 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ old('punya_hewan_lain') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            {{-- Checkbox Agreement --}}
            <div class="flex items-start gap-3">
                <input type="checkbox" 
                       name="agreement" 
                       id="agreement" 
                       class="mt-1 w-5 h-5 border-2 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                       required>
                <label for="agreement" class="text-sm text-gray-700 leading-relaxed">
                    Saya menyetakan bahwa semua informasi di atas benar, dan saya siap memberikan rumah penuh kasih untuk hewan ini.
                </label>
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-full shadow-lg transition transform hover:scale-105">
                    Ajukan Adopsi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection