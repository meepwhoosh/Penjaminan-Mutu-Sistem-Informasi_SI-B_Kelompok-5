@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Daftar Hewan (Admin)</h1>
            <p class="text-sm text-gray-600">Kelola semua hewan: lihat detail, edit, atau hapus.</p>
        </div>
        <a href="{{ route('admin.hewan.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Tambah Hewan</a>
    </div>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($hewan as $h)
            <div class="border p-4 rounded shadow-sm bg-white flex flex-col">
                <div class="w-full h-48 mb-2 rounded bg-gray-50 overflow-hidden">
                    @if($h->foto)
                        <img src="{{ asset('storage/'.$h->foto) }}" alt="{{ $h->nama }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Tidak ada foto</div>
                    @endif
                </div>
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $h->nama }}</h2>
                        <p class="text-sm text-gray-600">{{ $h->jenis }} - {{ $h->ras ?? '-' }}</p>
                    </div>
                    <x-status-badge :status="$h->status" />
                </div>
                <p class="text-sm mt-2 text-gray-700 line-clamp-2">{{ $h->deskripsi ?? 'Tidak ada deskripsi' }}</p>

                <div class="mt-3 flex gap-3 items-center">
                    <a href="{{ route('admin.hewan.show', $h) }}" class="text-indigo-600 font-semibold">Lihat</a>
                    <a href="{{ route('admin.hewan.edit', $h) }}" class="text-yellow-600 font-semibold">Edit</a>
                    <form action="{{ route('admin.hewan.destroy', $h) }}" method="POST" onsubmit="return confirm('Hapus hewan ini?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 font-semibold">Hapus</button>
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
