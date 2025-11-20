@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">{{ $hewan->nama }}</h1>
        <div class="flex gap-3">
            @auth
                <a href="{{ route('user.dashboard') }}" class="text-gray-600 underline">Dashboard</a>
            @endauth
            <a href="{{ route('hewan.index') }}" class="ms-4 text-gray-600 underline">Kembali</a>
        </div>
    </div>

    <div class="w-full h-64 mb-4 rounded bg-gray-50 overflow-hidden">
        @if($hewan->foto)
            <img src="{{ asset('storage/'.$hewan->foto) }}" alt="{{ $hewan->nama }}" class="w-full h-full object-cover">
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
