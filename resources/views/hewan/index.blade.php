@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Hewan</h1>
        <a href="{{ route('hewan.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah Hewan</a>
    </div>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($hewan as $h)
            <div class="border p-4 rounded">
                @if($h->foto)
                    <img src="{{ asset('storage/'.$h->foto) }}" alt="{{ $h->nama }}" class="w-full h-48 object-cover mb-2">
                @endif
                <h2 class="font-semibold text-lg">{{ $h->nama }}</h2>
                <p class="text-sm text-gray-600">{{ $h->jenis }} - {{ $h->ras ?? '-' }}</p>
                <p class="mt-2">Status: <strong>{{ $h->status }}</strong></p>

                <div class="mt-3 flex gap-2">
                    <a href="{{ route('hewan.show', $h) }}" class="text-indigo-600">Lihat</a>
                    <a href="{{ route('hewan.edit', $h) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('hewan.destroy', $h) }}" method="POST" onsubmit="return confirm('Hapus hewan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $hewan->links() }}
    </div>
</div>
@endsection
