@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Hewan</h1>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hewan.update', $hewan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $hewan->nama) }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Jenis</label>
            <input type="text" name="jenis" value="{{ old('jenis', $hewan->jenis) }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Ras</label>
            <input type="text" name="ras" value="{{ old('ras', $hewan->ras) }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Usia</label>
            <input type="number" name="usia" value="{{ old('usia', $hewan->usia) }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Foto</label>
            @if($hewan->foto)
                <img src="{{ asset('storage/'.$hewan->foto) }}" alt="foto" class="w-48 mb-2">
            @endif
            <input type="file" name="foto" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Status</label>
            <select name="status" class="border p-2 w-full">
                <option value="tersedia" {{ $hewan->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="diadopsi" {{ $hewan->status === 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
