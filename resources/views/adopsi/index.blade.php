@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Manajemen Adopsi</h1>
            <p class="text-sm text-gray-600">Pantau pengajuan adopsi dan ubah statusnya.</p>
        </div>
        <a href="{{ route('admin.adopsi.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Tambah Adopsi</a>
    </div>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-100 text-sm">
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
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $a->id }}</td>
                        <td class="p-3 border-b">{{ $a->user->nama ?? $a->user->name ?? 'User' }}</td>
                        <td class="p-3 border-b">{{ $a->hewan->nama ?? '-' }}</td>
                        <td class="p-3 border-b">
                            <x-status-badge :status="$a->status" />
                        </td>
                        <td class="p-3 border-b">{{ $a->tanggal_adopsi ?? '-' }}</td>
                        <td class="p-3 border-b text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.adopsi.show', $a) }}" class="text-indigo-600 font-semibold">Lihat</a>
                                <a href="{{ route('admin.adopsi.edit', $a) }}" class="text-yellow-600 font-semibold">Edit</a>
                                <form action="{{ route('admin.adopsi.destroy', $a) }}" method="POST" class="inline" onsubmit="return confirm('Hapus adopsi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-semibold">Hapus</button>
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
