@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Adopsi</h1>
        <a href="{{ route('adopsi.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah Adopsi</a>
    </div>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="space-y-4">
        @foreach($adopsi as $a)
            <div class="border p-4 rounded">
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-semibold">{{ $a->hewan->nama ?? '—' }} ({{ $a->hewan->jenis ?? '-' }})</h2>
                        <p class="text-sm text-gray-600">Pemohon: {{ $a->user->name ?? $a->user->nama ?? '-' }}</p>
                        <p class="text-sm">Tanggal: {{ $a->tanggal_adopsi ?? '-' }}</p>
                    </div>
                    <div class="text-right">
                        <p>Status: <strong>{{ $a->status }}</strong></p>
                        <div class="mt-2 flex gap-2 justify-end">
                            <a href="{{ route('adopsi.show', $a) }}" class="text-indigo-600">Lihat</a>
                            <a href="{{ route('adopsi.edit', $a) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('adopsi.destroy', $a) }}" method="POST" onsubmit="return confirm('Hapus adopsi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $adopsi->links() }}
    </div>
</div>
@endsection
