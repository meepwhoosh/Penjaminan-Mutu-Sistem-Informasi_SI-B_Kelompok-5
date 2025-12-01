@extends('layouts.app')

@section('title', 'Home - Adopt a Buddy')

@section('content')

<style>
/* === semua CSS kamu tadi copy-paste apa adanya di sini === */
/* ... MASUKKAN SEMUA CSS DARI FILE TADI DI SINI TANPA <style> BARU ... */
</style>

<!-- Hero Section -->
<section class="bg-[#F8BD00] pt-24 relative overflow-hidden">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between min-h-[500px]">
        
        {{-- Teks Hero (Kiri) --}}
        <div class="w-full md:w-1/2 mb-10 md:mb-0 z-10">
            <h1 class="text-[#3654A5] text-5xl md:text-6xl font-extrabold leading-tight tracking-tight max-w-lg">
                Every paw deserves a place to call home.
            </h1>
            <button 
                class="mt-8 px-8 py-3 bg-[#3654A5] text-white text-lg font-bold rounded-xl shadow-lg hover:bg-blue-700 transition duration-300" 
                onclick="window.location.href='{{ route('hewan.index') }}'">
                Find a friend
            </button>
        </div>
        
        {{-- Gambar Kucing (Kanan Bawah) --}}
        <img 
            src="{{ asset('images/Home1.png') }}" 
            alt="Cat Looking Up" 
            class="
                
                /* Posisi Absolut untuk efek offset */
                absolute 
                bottom-0 
                right-0 
                
                /* Ukuran: Ditingkatkan menjadi 650px */
                h-[600px]
                w-auto 
                
                /* Geser ke Kanan dan Bawah (Efek Offset) */
                -mr-1 
                mb-32
                
                /* Z-index: di belakang teks (z-0) */
                z-0
            "
        >
    </div>


<!-- Search Section -->
 <div class="bg-white pt-16 pb-10">
    {{-- Judul --}}
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-4xl font-extrabold text-[#3654A5] mb-10">Let's Find A Buddy</h2>
    </div>

    {{-- Form Filter --}}
    <form action="{{ route('hewan.index') }}" class="flex flex-col md:flex-row items-center justify-center gap-4 max-w-4xl mx-auto px-4" method="GET">
        
        {{-- Input Tersembunyi untuk Jenis Hewan (Dog/Cat) --}}
        <input type="hidden" name="jenis" id="jenis-input" value="{{ request('jenis') }}">
            
            {{-- Dog --}}
            <button type="submit" name="jenis" value="anjing" 
                class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition {{ request('jenis') == 'anjing' ? 'text-blue-700' : '' }}">
                <div class="w-16 h-16 border-2 {{ request('jenis') == 'anjing' ? 'border-blue-700' : 'border-gray-400' }} rounded-lg flex items-center justify-center text-3xl hover:border-gray-600">
                    🐶
                </div>
                <span class="text-sm mt-2 font-medium">Dog</span>
            </button>

            {{-- Cat --}}
            <button type="submit" name="jenis" value="kucing"
                class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition {{ request('jenis') == 'kucing' ? 'text-blue-700' : '' }}">
                <div class="w-16 h-16 border-2 {{ request('jenis') == 'kucing' ? 'border-blue-700' : 'border-gray-400' }} rounded-lg flex items-center justify-center text-3xl hover:border-gray-600">
                    🐱
                </div>
                <span class="text-sm mt-2 font-medium">Cat</span>
            </button>
        
        {{-- Gender Dropdown --}}
        <select name="gender" class="flex-grow px-8 py-2.5 rounded-full border-2 border-gray-300 bg-yellow-400 text-gray-800 font-medium shadow-sm focus:outline-none focus:border-yellow-500">
            <option value="">Gender</option>
            <option value="jantan" {{ request('gender') == 'jantan' ? 'selected' : '' }}>Male</option>
            <option value="betina" {{ request('gender') == 'betina' ? 'selected' : '' }}>Female</option>
        </select>

        {{-- Age Dropdown --}}
        <select name="usia" class="flex-grow px-8 py-2.5 rounded-full border-2 border-gray-300 bg-yellow-400 text-gray-800 font-medium shadow-sm focus:outline-none focus:border-yellow-500">
            <option value="">Age</option>
            <option value="1" {{ request('usia') == '1' ? 'selected' : '' }}>1 year</option>
            <option value="2" {{ request('usia') == '2' ? 'selected' : '' }}>2 years</option>
            <option value="3" {{ request('usia') == '3' ? 'selected' : '' }}>3 years</option>
            <option value="4" {{ request('usia') == '4' ? 'selected' : '' }}>4 years</option>
            <option value="5" {{ request('usia') == '5' ? 'selected' : '' }}>5+ years</option>
        </select>

        {{-- Find Button (Submit) --}}
        <button type="submit"
            class="px-8 py-2.5 bg-blue-700 text-white rounded-full shadow-md hover:bg-blue-800 font-medium transition">
            Find
        </button>
            
        {{-- Reset Button --}}
        @if(request()->hasAny(['jenis', 'gender', 'usia']))
        <a href="{{ route('hewan.index') }}"
            class="px-8 py-2.5 bg-gray-500 text-white rounded-full shadow-md hover:bg-gray-600 font-medium transition">
            Reset
        </a>
        @endif
    </form>
</div>

<style>
/* Menambahkan style kustom untuk tombol Dog/Cat agar menyerupai filter-item */
.filter-button {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100px; /* Lebar tetap untuk tombol filter */
    height: 100px; /* Tinggi tetap untuk tombol filter */
    border-radius: 50%;
    border-width: 2px;
    padding: 0;
    text-align: center;
    cursor: pointer;
}
.filter-icon {
    width: 40px;
    height: 40px;
    margin-bottom: 4px;
}
</style>
</section>

<!-- Welcome Section -->
<section class="bg-[#3654A5] relative overflow-visible">
    <div class="mx-auto px-16 py-8 flex flex-col md:flex-row items-center min-h-[300px]">
        
        {{-- Gambar Anjing (Kiri) - Posisi dari bawah --}}
        <div class="w-full md:w-1/2 relative flex items-end justify-start z-10 md:mb-[-253px]">
            <img 
                src="{{ asset('images/Home2.png') }}" 
                alt="Dog" 
                class="h-auto max-h-[650px] w-auto object-contain relative z-10"
            >
        </div>
        
        {{-- Konten Welcome (Kanan) --}}
        <div class="w-full md:w-1/2 text-right px-8 py-12">
            <img 
                src="{{ asset('images/paw.png') }}" 
                alt="paw" 
                class="w-[80px] relative z-10 -mb-10 ml-8"
            >
            
            <h2 class="text-[#F8BD00] text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                Welcome to<br>Adopt A Buddy
            </h2>
            <p class="text-[#F8BD00] text-lg md:text-xl leading-relaxed font-medium">
                Ready to change a life? Browse our loving animals and find your new companion today. 
                Explore hundreds of amazing pets waiting for their forever family.
            </p>
        </div>
    </div>

<!-- Stories Section -->
    <div class="px-16 py-16 bg-white flex flex-col md:flex-row gap-12 relative">

    <div class="w-full md:w-1/3 md:mt-20">
        
        <h2 class="text-[#3654A5] text-5xl md:text-6xl font-extrabold mb-12">
            <br><br>Stories from<br>Adopters
        </h2>

    </div>
    <div class="w-full md:w-2/3">
        
        <div class="space-y-12">
            
            {{-- Story 1 --}}
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <img 
                        src="{{ asset('images/Home6.jpeg') }}" 
                        alt="Milo" 
                        class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-[#3654A5]"
                    >
                </div>
                <div class="flex-1">
                    <p class="text-[#3654A5] text-xl md:text-2xl leading-relaxed mb-3">
                        "Sejak mengadopsi Milo, rumah jadi lebih ramai dan penuh tawa. Dia bukan cuma peliharaan, tapi bagian dari keluarga kami."
                    </p>
                    <p class="text-[#F8BD00] text-2xl font-bold">
                        – Tasya
                    </p>
                </div>
            </div>
            
            {{-- Story 2 --}}
            <div class="flex items-start gap-6 md:ml-auto md:max-w-4xl">
                <div class="flex-shrink-0 order-2 md:order-2">
                    <img 
                        src="{{ asset('images/Home7.jpeg') }}" 
                        alt="Koko" 
                        class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-[#3654A5]"
                    >
                </div>
                <div class="flex-1 order-1 md:order-1 md:text-right">
                    <p class="text-[#3654A5] text-xl md:text-2xl leading-relaxed mb-3">
                        "Awalnya cuma lihat-lihat, eh sekarang tiap pagi dibangunin sama Koko yang minta sarapan 😂."
                    </p>
                    <p class="text-[#F8BD00] text-2xl font-bold">
                        – Dimas
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</div>
</section>

<!-- Ready Section -->
<section class="ready-section">
    <div class="ready-content">
        <div class="flex items-end gap-2">
            <h2 class="ready-title">He's ready for <br>cuddles, are <br> you?</h2>
            <div class="paw-icons mb-2">
                <img 
                    src="{{ asset('images/paw.png') }}" 
                    alt="paw" 
                    class="w-20 h-auto"
                >
            </div>
        </div>
        <button class="ready-button mt-6" onclick="window.location.href='{{ route('pets') }}'">Find a friend</button>
    </div>

    <div class="ready-image">
        <img src="{{ asset('images/Home3.png') }}" alt="Cat" class="w-[450px]">
    </div>
</section>

<!-- How to Adopt Section -->
<section class="relative py-20 bg-white overflow-hidden ">
    <h2 class="adopt-title text-center text-[#3654A5] text-5xl md:text-6xl font-extrabold mb-20">
        How to <br>Adopt?
    </h2>

    <div class="relative">
        {{-- Gambar Tangan Kiri --}}
        <div class="absolute left-0 bottom-0 w-[380px] z-10">
            <img 
                src="{{ asset('images/Home5.png') }}" 
                alt="Cat Paw Left" 
                class="w-full h-auto object-contain"
            >
        </div>

        {{-- Gambar Ekor Kanan --}}
        <div class="absolute right-0 bottom-0 w-[480px] z-10">
            <img 
                src="{{ asset('images/Home4.png') }}" 
                alt="Cat Tail Right" 
                class="w-full h-auto object-contain"
            >
        </div>

        {{-- Steps Container --}}
        <div class="relative z-20 max-w-6xl mx-auto px-16">
            <div class="flex justify-center gap-[800px] mb-20">
                {{-- Step 1: Choose your buddy (Kiri Atas) --}}
                <div class="adopt-step">
                    <div class="w-60 h-60 rounded-full bg-[#F8BD00] flex items-center justify-center">
                        <span class="text-[#3654A5] text-2xl font-bold text-center leading-tight">Choose your<br>buddy</span>
                    </div>
                </div>

                {{-- Step 4: Bring them home (Kanan Atas) --}}
                <div class="adopt-step">
                    <div class="w-60 h-60 rounded-full bg-[#3654A5] flex items-center justify-center">
                        <span class="text-[#F8BD00] text-2xl font-bold text-center leading-tight">Bring them<br>home!</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center gap-40">
                {{-- Step 2: Fill out the form (Kiri Bawah) --}}
                <div class="adopt-step">
                    <div class="w-60 h-60 rounded-full bg-[#3654A5] flex items-center justify-center">
                        <span class="text-[#F8BD00] text-2xl font-bold text-center leading-tight">Fill out the<br>form</span>
                    </div>
                </div>

                {{-- Step 3: Meet & greet (Kanan Bawah) --}}
                <div class="adopt-step">
                    <div class="w-60 h-60 rounded-full bg-[#F8BD00] flex items-center justify-center">
                        <span class="text-[#3654A5] text-2xl font-bold text-center leading-tight">Meet & greet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
