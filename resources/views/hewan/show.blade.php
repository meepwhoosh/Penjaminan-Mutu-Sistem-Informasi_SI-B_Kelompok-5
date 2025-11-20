@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">{{ $hewan->nama }}</h1>
        <div>
            <a href="{{ route('hewan.edit', $hewan) }}" class="text-yellow-600">Edit</a>
            <a href="{{ route('hewan.index') }}" class="ms-4 text-gray-600">Kembali</a>
        </div>
    </div>

    @if($hewan->foto)
        <img src="{{ asset('storage/'.$hewan->foto) }}" alt="{{ $hewan->nama }}" class="w-full h-64 object-cover mb-4">
    @endif

    <p><strong>Jenis:</strong> {{ $hewan->jenis }}</p>
    <p><strong>Ras:</strong> {{ $hewan->ras ?? '-' }}</p>
    <p><strong>Usia:</strong> {{ $hewan->usia ?? '-' }}</p>
    <p><strong>Status:</strong> {{ $hewan->status }}</p>
</div>
@endsection
