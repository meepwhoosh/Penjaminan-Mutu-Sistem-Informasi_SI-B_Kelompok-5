@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Detail Hewan</p>
            <h1 class="text-3xl font-bold text-blue-900">{{ $hewan->nama }}</h1>
            <p class="text-sm text-gray-600">{{ ucfirst($hewan->jenis) }} • {{ $hewan->ras ?? '-' }}</p>
        </div>
        <div class="flex flex-wrap gap-2 items-center">
            <x-status-badge :status="$hewan->status" />
            <a href="{{ route('admin.hewan.edit', $hewan) }}" class="px-3 py-2 rounded-full bg-yellow-100 text-yellow-800 font-semibold hover:bg-yellow-200 transition">Edit</a>
            <a href="{{ route('admin.hewan.index') }}" class="px-3 py-2 rounded-full bg-blue-100 text-blue-800 font-semibold hover:bg-blue-200 transition">Kembali</a>
        </div>
    </div>

    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 flex flex-col md:flex-row gap-6">
        <div class="flex-1 flex items-center justify-center">
            @php
                $fotoUrl = asset('images/paw.png');
                if ($hewan->foto) {
                    if (str_starts_with($hewan->foto, 'hewan/')) {
                        $fotoUrl = asset('storage/'.$hewan->foto);
                    } elseif (str_starts_with($hewan->foto, 'http')) {
                        $fotoUrl = $hewan->foto;
                    } else {
                        $fotoUrl = asset('images/'.$hewan->foto);
                    }
                }
            @endphp
            <img src="{{ $fotoUrl }}" alt="{{ $hewan->nama }}" class="max-h-[420px] w-auto object-contain rounded-xl shadow-sm">
        </div>
        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4 text-blue-900">
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Usia</p>
                <p class="text-lg font-semibold">{{ $hewan->usia ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Gender</p>
                <p class="text-lg font-semibold">{{ $hewan->gender ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Warna</p>
                <p class="text-lg font-semibold">{{ $hewan->warna ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Kepribadian</p>
                <p class="text-lg font-semibold">{{ $hewan->kepribadian ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm sm:col-span-2">
                <p class="text-xs text-gray-500 uppercase">Deskripsi</p>
                <p class="text-sm text-gray-700 mt-1">{{ $hewan->deskripsi ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
