@extends('layouts.app')

@section('content')
<div class="w-full bg-white">

    {{-- Hero Section (Tidak Berubah) --}}
    <div class="w-full bg-white py-14 mt-20">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl font-bold text-blue-900 mb-12">About Us</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center max-h-[150px]">
                {{-- Left Text --}}
                <div>
                    <p class="text-yellow-500 text-[30px] leading-relaxed">
                        Adopt A Buddy adalah platform adopsi yang secara khusus berfokus pada penyelamatan dan penyaluran
                        anjing serta kucing yang membutuhkan rumah baru. Kami hadir untuk menjadi penghubung antara
                        hewan terlantar dengan calon adopter yang siap memberikan kasih sayang, perhatian, dan tanggung jawab.
                    </p>
                </div>

                {{-- Right Image --}}
                <div class="flex justify-end">
                    <img src="{{ asset('images/about1.png') }}" alt="Orange Cat" class="w-[1000px] h-auto object-contain">
                </div>
            </div>
        </div>
    </div>

    {{-- Second Section --}}
    {{-- Diubah: py-20 -> pt-20 pb-10 (Mengurangi padding bawah) --}}
    <div class="w-full pt-20 pb-10 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center max-h-[400px]">
                {{-- Left Image --}}
                <div class="flex justify-start">
                    <img src="{{ asset('images/about2.png') }}" alt="Dog Top View" class="w-[500px] h-auto object-contain rotate-90">
                </div>

                {{-- Right Text --}}
                <div>
                    <p class="text-yellow-500 text-[30px] leading-relaxed">
                        Kami bekerja sama dengan relawan dan shelter untuk merawat anjing dan kucing yang diselamatkan,
                        memastikan mereka mendapatkan perawatan yang layak sebelum diadopsi. Adopt A Buddy juga berkomitmen
                        untuk menyediakan proses adopsi yang transparan, aman, dan bertanggung jawab bagi semua pihak.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Third Section --}}
    {{-- Diubah: py-20 -> pt-10 pb-20 (Mengurangi padding atas) --}}
    <div class="w-full pt-10 pb-20 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                {{-- Left Text --}}
                <div>
                    <p class="text-yellow-500 text-[30px] leading-relaxed">
                        Kami berharap setiap anjing dan kucing dapat memperoleh kesempatan hidup yang lebih baik melalui adopsi.
                        Dengan memilih mengadopsi, Anda tidak hanya menyelamatkan satu kehidupan, tetapi juga membuka ruang
                        bagi terciptanya hubungan yang penuh cinta dan kepedulian antara manusia dan hewan.
                    </p>
                </div>

                {{-- Right Image --}}
                <div class="flex justify-end">
                    <img src="{{ asset('images/about3.png') }}" alt="Ginger Cat" class="w-[1000px] h-auto object-contain -rotate-90">
                </div>
            </div>
        </div>
    </div>

</div>
@endsection 