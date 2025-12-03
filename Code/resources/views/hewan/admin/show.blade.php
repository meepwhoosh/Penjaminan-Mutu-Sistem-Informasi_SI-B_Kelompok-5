@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">{{ $hewan->nama }}</h1>
            <p class="text-sm text-gray-600">{{ $hewan->jenis }} - {{ $hewan->ras ?? '-' }}</p>
        </div>
        <div class="flex gap-3 items-center">
            <x-status-badge :status="$hewan->status" />
            <a href="{{ route('admin.hewan.edit', $hewan) }}" class="text-yellow-600 font-semibold">Edit</a>
            <a href="{{ route('admin.hewan.index') }}" class="text-gray-600 underline">Kembali</a>
        </div>
    </div>

    <div class="w-full h-64 mb-4 rounded bg-gray-50 overflow-hidden">
        @if($hewan->foto)
            <img src="{{ asset('storage/'.$hewan->foto) }}" alt="{{ $hewan->nama }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Tidak ada foto</div>
        @endif
    </div>

    <div class="bg-white rounded shadow p-4 space-y-2">
        <p><strong>Deskripsi:</strong> {{ $hewan->deskripsi ?? '-' }}</p>
        <p><strong>Usia:</strong> {{ $hewan->usia ?? '-' }} tahun</p>
        <p><strong>Status:</strong>
            <x-status-badge :status="$hewan->status" />
        </p>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.hewan.index') }}" class="text-gray-600 underline">Kembali ke daftar</a>
    </div>

</div>
@endsection
