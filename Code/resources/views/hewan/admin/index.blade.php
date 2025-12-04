@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-blue-900">Kelola Hewan</h1>
            <p class="text-sm text-gray-600">Filter, lihat detail, edit, atau hapus data hewan.</p>
        </div>
        <a href="{{ route('admin.hewan.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-full shadow hover:bg-blue-800 transition">
            + Tambah Hewan
        </a>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 items-center mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/ras..."
            class="flex-1 min-w-[220px] border-2 border-blue-200 rounded-full px-4 py-3 bg-white text-blue-900 font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <div class="relative">
            <select name="status" class="w-full appearance-none border-2 border-blue-200 rounded-full px-4 py-3 pr-10 bg-white text-blue-900 font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="diadopsi" {{ request('status') == 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
            </select>
            <svg class="w-4 h-4 text-blue-700 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="relative">
            <select name="jenis" class="w-full appearance-none border-2 border-blue-200 rounded-full px-4 py-3 pr-10 bg-white text-blue-900 font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Jenis</option>
                <option value="anjing" {{ request('jenis') == 'anjing' ? 'selected' : '' }}>Anjing</option>
                <option value="kucing" {{ request('jenis') == 'kucing' ? 'selected' : '' }}>Kucing</option>
            </select>
            <svg class="w-4 h-4 text-blue-700 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="relative">
            <select name="gender" class="w-full appearance-none border-2 border-blue-200 rounded-full px-4 py-3 pr-10 bg-white text-blue-900 font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Gender</option>
                <option value="jantan" {{ request('gender') == 'jantan' ? 'selected' : '' }}>Jantan</option>
                <option value="betina" {{ request('gender') == 'betina' ? 'selected' : '' }}>Betina</option>
            </select>
            <svg class="w-4 h-4 text-blue-700 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
            </svg>
        </div>
        <button type="submit" class="bg-blue-700 text-white rounded-full px-5 py-3 shadow hover:bg-blue-800 transition">
            Filter
        </button>
    </form>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($hewan as $h)
            <div class="rounded-3xl border border-yellow-500 bg-yellow-100 p-4 shadow-sm flex flex-col gap-3 hover:shadow-md transition">
                <div class="w-full h-48 rounded-2xl overflow-hidden bg-white border-4 border-yellow-500 flex items-center justify-center">
                    @php
                        $fotoUrl = asset('images/paw.png');
                        if ($h->foto) {
                            if (str_starts_with($h->foto, 'hewan/')) {
                                $fotoUrl = asset('storage/'.$h->foto);
                            } elseif (str_starts_with($h->foto, 'http')) {
                                $fotoUrl = $h->foto;
                            } else {
                                $fotoUrl = asset('images/'.$h->foto);
                            }
                        }
                    @endphp
                    <img src="{{ $fotoUrl }}" alt="{{ $h->nama }}" class="max-h-full max-w-full object-contain">
                </div>
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h2 class="font-semibold text-lg text-blue-900">{{ $h->nama }}</h2>
                        <p class="text-sm text-blue-800">{{ ucfirst($h->jenis) }} • {{ $h->ras ?? '-' }}</p>
                    </div>
                    <x-status-badge :status="$h->status" />
                </div>
                <div class="text-sm text-blue-900 space-y-1">
                    <div class="flex items-center gap-2">
                        <span>{{ $h->gender === 'betina' ? '♀' : '♂' }}</span>
                        <span>{{ $h->usia ?? '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🎨</span>
                        <span>{{ $h->warna ?? '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>✨</span>
                        <span class="line-clamp-1">{{ $h->kepribadian ?? $h->deskripsi ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-auto flex gap-2">
                    <a href="{{ route('admin.hewan.show', $h) }}" class="flex-1 text-center bg-blue-700 text-white py-2 rounded-full font-semibold hover:bg-blue-800 transition">Detail</a>
                    <a href="{{ route('admin.hewan.edit', $h) }}" class="flex-1 text-center bg-white text-blue-800 py-2 rounded-full font-semibold border border-blue-800 hover:bg-blue-50 transition">Edit</a>
                    <form action="{{ route('admin.hewan.destroy', $h) }}" method="POST" onsubmit="return confirm('Hapus hewan ini?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 rounded-full font-semibold text-red-700 border border-red-200 hover:bg-red-50 transition">Hapus</button>
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
