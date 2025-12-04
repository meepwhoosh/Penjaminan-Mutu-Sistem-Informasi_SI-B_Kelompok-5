@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">{{ $hewan->nama }}</h1>
        <div>
            <a href="{{ route('admin.hewan.edit', $hewan) }}" class="text-yellow-600">Edit</a>
            <a href="{{ route('admin.hewan.index') }}" class="ms-4 text-gray-600">Kembali</a>
        </div>
    </div>

    <div class="w-full h-64 mb-4 rounded bg-gray-50 overflow-hidden">
        @php
            $fotoUrl = null;
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
        @if($fotoUrl)
            <img src="{{ $fotoUrl }}" alt="{{ $hewan->nama }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Tidak ada foto</div>
        @endif
    </div>

    <p><strong>Jenis:</strong> {{ $hewan->jenis }}</p>
    <p><strong>Ras:</strong> {{ $hewan->ras ?? '-' }}</p>
    <p class="mt-2"><strong>Deskripsi:</strong> {{ $hewan->deskripsi ?? '-' }}</p>
    <p><strong>Usia:</strong> {{ $hewan->usia ?? '-' }}</p>
    <p><strong>Status:</strong> {{ $hewan->status }}</p>
    @auth
        @if(auth()->user()->role === 'user' && $hewan->status === 'tersedia')
            <div class="mt-4">
                @if(session('status'))
                    <div class="mb-2 text-green-600">{{ session('status') }}</div>
                @endif

                <a href="{{ route('hewan.adopsi.form', $hewan) }}"
                   class="inline-flex items-center font-semibold px-4 py-2 rounded shadow focus:outline-none bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500">
                    Ajukan Adopsi
                </a>
            </div>
        @endif
    @endauth
</div>
@endsection
