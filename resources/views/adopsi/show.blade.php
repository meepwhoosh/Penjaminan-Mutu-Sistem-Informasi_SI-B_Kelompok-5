@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Detail Adopsi</h1>

    <div class="border p-4 rounded">
        <h2 class="font-semibold">{{ $adopsi->hewan->nama ?? '—' }} ({{ $adopsi->hewan->jenis ?? '-' }})</h2>
        <p class="text-sm text-gray-600">Pemohon: {{ $adopsi->user->name ?? $adopsi->user->nama ?? '-' }}</p>
        <p class="text-sm">Tanggal: {{ $adopsi->tanggal_adopsi ?? '-' }}</p>
        <p class="mt-2">Status: <strong>{{ $adopsi->status }}</strong></p>
    </div>
</div>
@endsection
