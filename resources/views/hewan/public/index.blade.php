@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Hewan yang Tersedia</h1>
        @auth
            <a href="{{ route('user.dashboard') }}" class="text-gray-600 underline">Kembali ke dashboard</a>
        @endauth
    </div>

    <form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/jenis/ras" class="w-full border p-2 rounded">
        </div>
        <div>
            <input type="text" name="jenis" value="{{ request('jenis') }}" placeholder="Filter jenis (contoh: Kucing)" class="w-full border p-2 rounded">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Cari</button>
            <a href="{{ route('hewan.index') }}" class="text-gray-600 underline px-4 py-2">Reset</a>
        </div>
    </form>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($hewan as $h)
            <div class="border p-4 rounded shadow-sm bg-white">
                <div class="w-full h-48 mb-2 rounded bg-gray-50 overflow-hidden">
                    @if($h->foto)
                        <img src="{{ asset('storage/'.$h->foto) }}" alt="{{ $h->nama }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Tidak ada foto</div>
                    @endif
                </div>
                <h2 class="font-semibold text-lg">{{ $h->nama }}</h2>
                <p class="text-sm text-gray-600">{{ $h->jenis }} - {{ $h->ras ?? '-' }}</p>
                <p class="mt-2">Status: <strong>{{ $h->status }}</strong></p>

                <div class="mt-3">
                    <a href="{{ route('hewan.show', $h) }}" class="text-indigo-600">Lihat</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $hewan->links() }}
    </div>
</div>
@endsection
