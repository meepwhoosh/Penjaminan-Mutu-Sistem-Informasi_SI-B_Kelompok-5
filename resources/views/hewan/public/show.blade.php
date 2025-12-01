@extends('layouts.app')

@section('content')
<div class="w-full bg-gray-50 py-10 px-4 mt-28">

    <div class="max-w-5xl mx-auto bg-white border-4 border-yellow-400 rounded-xl p-6 shadow">

        {{-- Back Button --}}
        <a href="{{ route('hewan.index') }}" class="text-blue-600 text-2xl font-bold">←</a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">

            {{-- IMAGE --}}
            <div class="w-full">
                <div class="w-full h-80 bg-white border border-gray-300 rounded-xl overflow-hidden">
                    @if($hewan->foto)
                    <img src="{{ asset('images/'.$hewan->foto) }}"
                        class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            {{-- INFO --}}
            <div>
                <h1 class="text-3xl font-bold text-blue-900">{{ $hewan->nama }}</h1>

                <p class="mt-3"><strong>Gender:</strong> {{ $hewan->gender ?? 'Tidak diketahui' }}</p>
                <p><strong>Umur:</strong> {{ $hewan->usia ?? '-' }}</p>
                <p><strong>Ras:</strong> {{ $hewan->ras ?? '-' }}</p>
                <p><strong>Warna:</strong> {{ $hewan->warna ?? '-' }}</p>
                <p><strong>Kepribadian:</strong> {{ $hewan->kepribadian ?? '-' }}</p>

            </div>
        </div>

        {{-- Description --}}
        <div class="mt-8">
            <h2 class="text-xl font-bold text-yellow-600">Cerita tentang {{ $hewan->nama }}</h2>
            <p class="mt-2 text-gray-700 leading-relaxed">
                {{ $hewan->deskripsi ?? 'Tidak ada deskripsi.' }}
            </p>
        </div>

        {{-- HEALTH TABLE (jika ada) --}}
    <div class="mt-10">
        <h2 class="text-xl font-bold text-yellow-600">Kesehatan Hewan</h2>

        <table class="w-full mt-3 border border-gray-300">
            <thead class="bg-yellow-300">
                <tr>
                    <th class="p-2 border">Vaksin</th>
                    <th class="p-2 border">Tanggal Cek</th>
                    <th class="p-2 border">Riwayat Penyakit/Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hewan->kesehatan as $data)
                <tr>
                    <td class="p-2 border text-center">{{ $data->vaksin ?? 'Belum ada data' }}</td>
                    <td class="p-2 border text-center">{{ $data->tanggal_cek ? \Carbon\Carbon::parse($data->tanggal_cek)->format('d-M-Y') : '-' }}</td>
                    <td class="p-2 border text-center">{{ $data->penyakit ?? 'Sehat' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        Belum ada riwayat kesehatan yang tercatat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        {{-- Adopt Button --}}
        @auth
            @if(auth()->user()->role === 'user' && $hewan->status === 'tersedia')
            <div class="flex justify-center mt-10">
                <a href="{{ route('hewan.adopsi.form', $hewan) }}"
                    class="bg-yellow-400 hover:bg-yellow-500 px-8 py-3 rounded-full font-bold text-blue-900 shadow-md">
                    Let's Adopt Me!
                </a>
            </div>
            @endif
        @endauth

    </div>

</div>
@endsection
