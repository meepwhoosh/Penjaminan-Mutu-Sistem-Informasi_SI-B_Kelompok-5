@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-blue-900">Manage Adoption</h1>
            <p class="text-sm text-gray-600">Pantau permintaan adopsi dan kelola statusnya.</p>
        </div>
        <a href="{{ route('admin.adopsi.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-full shadow hover:bg-blue-800 transition">+ Tambah Adopsi</a>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 items-center mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user/hewan..."
            class="flex-1 min-w-[220px] border-2 border-blue-200 rounded-full px-4 py-3 bg-white text-blue-900 font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <div class="relative">
            <select name="status" class="w-full appearance-none border-2 border-blue-200 rounded-full px-4 py-3 pr-10 bg-white text-blue-900 font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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
        <button type="submit" class="bg-blue-700 text-white rounded-full px-5 py-3 shadow hover:bg-blue-800 transition">Filter</button>
    </form>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded-2xl shadow">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-blue-50 text-sm text-blue-900">
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">User</th>
                    <th class="p-3 border-b">Hewan</th>
                    <th class="p-3 border-b">Status</th>
                    <th class="p-3 border-b">Tanggal</th>
                    <th class="p-3 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adopsi as $a)
                    <tr class="hover:bg-blue-50/60">
                        <td class="p-3 border-b">{{ $a->id }}</td>
                        <td class="p-3 border-b">{{ $a->user->name ?? 'User' }}</td>
                        <td class="p-3 border-b">{{ $a->hewan->nama ?? '-' }}</td>
                        <td class="p-3 border-b">
                            <x-status-badge :status="$a->status" />
                        </td>
                        <td class="p-3 border-b">{{ $a->tanggal_adopsi ? \Carbon\Carbon::parse($a->tanggal_adopsi)->format('d M Y') : '-' }}</td>
                        <td class="p-3 border-b text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.adopsi.show', $a) }}" class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold hover:bg-blue-200 transition">Detail</a>
                                <a href="{{ route('admin.adopsi.edit', $a) }}" class="px-3 py-1 rounded-full bg-white border border-yellow-500 text-yellow-700 text-sm font-semibold hover:bg-yellow-50 transition">Edit</a>
                                <form action="{{ route('admin.adopsi.destroy', $a) }}" method="POST" class="inline" onsubmit="return confirm('Hapus adopsi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 rounded-full bg-white border border-red-300 text-red-700 text-sm font-semibold hover:bg-red-50 transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $adopsi->links() }}
    </div>
</div>
@endsection
