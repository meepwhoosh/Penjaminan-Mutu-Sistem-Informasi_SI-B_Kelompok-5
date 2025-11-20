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

    <form action="{{ route('admin.hewan.update', $hewan) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $hewan->nama) }}" class="border p-2 w-full rounded">
            @error('nama')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Jenis</label>
            <input type="text" name="jenis" value="{{ old('jenis', $hewan->jenis) }}" class="border p-2 w-full rounded">
            @error('jenis')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Ras</label>
            <input type="text" name="ras" value="{{ old('ras', $hewan->ras) }}" class="border p-2 w-full rounded">
            @error('ras')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="border p-2 w-full rounded" rows="4">{{ old('deskripsi', $hewan->deskripsi) }}</textarea>
            <p class="text-sm text-gray-500 mt-1">Opsional. Maks 1000 karakter.</p>
            @error('deskripsi')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Usia</label>
            <input type="number" name="usia" value="{{ old('usia', $hewan->usia) }}" class="border p-2 w-full rounded">
            @error('usia')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Foto</label>
            @if($hewan->foto)
                <img src="{{ asset('storage/'.$hewan->foto) }}" alt="foto" class="w-48 mb-2 rounded">
            @endif
            <input type="file" name="foto" class="border p-2 w-full rounded">
            <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak mengganti. Format jpg/jpeg/png/webp, maks 5 MB.</p>
            @error('foto')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Status</label>
            <select name="status" class="border p-2 w-full rounded">
                <option value="tersedia" {{ $hewan->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="diadopsi" {{ $hewan->status === 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
            </select>
            @error('status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-2 items-center">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Update</button>
            <a href="{{ route('admin.hewan.index') }}" class="text-gray-600 underline">Kembali</a>
        </div>
    </form>
</div>
@endsection
