@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 space-y-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Admin</p>
            <h1 class="text-3xl font-bold text-blue-900">Detail Adopsi</h1>
            <p class="text-sm text-gray-600">Informasi pengajuan dan status terbaru.</p>
        </div>
        <a href="{{ route('admin.adopsi.index') }}" class="text-blue-700 font-semibold hover:underline">← Kembali</a>
    </div>

    <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 uppercase">Hewan</p>
                <h2 class="font-semibold text-lg text-blue-900">{{ $adopsi->hewan->nama ?? '-' }} ({{ $adopsi->hewan->jenis ?? '-' }})</h2>
            </div>
            <x-status-badge :status="$adopsi->status" />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-blue-900">
            <div class="bg-blue-50 rounded-xl p-4">
                <p class="text-xs text-gray-500 uppercase">Pemohon</p>
                <p class="font-semibold">{{ $adopsi->user->name ?? $adopsi->user->nama ?? '-' }}</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-4">
                <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                <p class="font-semibold">{{ $adopsi->tanggal_adopsi ? \Carbon\Carbon::parse($adopsi->tanggal_adopsi)->format('d M Y') : '-' }}</p>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.adopsi.edit', $adopsi) }}" class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-semibold hover:bg-yellow-200 transition">Edit</a>
            <a href="{{ route('admin.adopsi.index') }}" class="px-4 py-2 rounded-full bg-blue-100 text-blue-800 font-semibold hover:bg-blue-200 transition">Kembali</a>
        </div>
    </div>
</div>
@endsection
