@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">{{ $hewan->nama }}</h1>
        <div>
            <a href="{{ route('hewan.edit', $hewan) }}" class="text-yellow-600">Edit</a>
            <a href="{{ route('hewan.index') }}" class="ms-4 text-gray-600">Kembali</a>
        </div>
    </div>

    @if($hewan->foto)
        <img src="{{ asset('storage/'.$hewan->foto) }}" alt="{{ $hewan->nama }}" class="w-full h-64 object-cover mb-4">
    @endif

    <p><strong>Jenis:</strong> {{ $hewan->jenis }}</p>
    <p><strong>Ras:</strong> {{ $hewan->ras ?? '-' }}</p>
    <p><strong>Usia:</strong> {{ $hewan->usia ?? '-' }}</p>
    <p><strong>Status:</strong> {{ $hewan->status }}</p>
    @auth
        @if(auth()->user()->role === 'user' && $hewan->status === 'tersedia')
            <div class="mt-4">
                @if(session('status'))
                    <div class="mb-2 text-green-600">{{ session('status') }}</div>
                @endif

                <form action="{{ route('hewan.adopsi.request', $hewan) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Ajukan Adopsi</button>
                </form>
            </div>
        @endif
    @endauth
</div>
@endsection
