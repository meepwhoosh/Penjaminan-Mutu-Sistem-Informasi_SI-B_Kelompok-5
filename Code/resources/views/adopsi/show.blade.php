@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Detail Adopsi</h1>
            <p class="text-sm text-gray-600">Informasi pengajuan dan status terbaru.</p>
        </div>
        <a href="{{ route('admin.adopsi.index') }}" class="text-gray-600 underline">Kembali ke daftar</a>
    </div>

    <div class="bg-white border p-4 rounded shadow space-y-2">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold">{{ $adopsi->hewan->nama ?? '-' }} ({{ $adopsi->hewan->jenis ?? '-' }})</h2>
            <x-status-badge :status="$adopsi->status" />
        </div>
        <p class="text-sm text-gray-600">Pemohon: {{ $adopsi->user->name ?? $adopsi->user->nama ?? '-' }}</p>
        <p class="text-sm">Tanggal: {{ $adopsi->tanggal_adopsi ?? '-' }}</p>
    </div>
</div>
@endsection
