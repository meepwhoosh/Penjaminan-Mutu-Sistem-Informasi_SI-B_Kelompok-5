@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Hewan</h1>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hewan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="border p-2 w-full rounded" placeholder="Contoh: Milo">
            @error('nama')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Jenis</label>
            <input type="text" name="jenis" value="{{ old('jenis') }}" class="border p-2 w-full rounded" placeholder="Kucing / Anjing">
            @error('jenis')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Ras</label>
            <input type="text" name="ras" value="{{ old('ras') }}" class="border p-2 w-full rounded" placeholder="Persia / Bulldog">
            @error('ras')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="border p-2 w-full rounded" rows="4" placeholder="Ceritakan karakter hewan...">{{ old('deskripsi') }}</textarea>
            <p class="text-sm text-gray-500 mt-1">Opsional. Maks 1000 karakter.</p>
            @error('deskripsi')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Usia</label>
            <input type="number" name="usia" value="{{ old('usia') }}" class="border p-2 w-full rounded" placeholder="dalam tahun">
            @error('usia')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Foto</label>
            <input type="file" name="foto" class="border p-2 w-full rounded">
            <p class="text-sm text-gray-500 mt-1">Format jpg/jpeg/png/webp, maks 5 MB.</p>
            @error('foto')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Status</label>
            <select name="status" class="border p-2 w-full rounded">
                <option value="tersedia">Tersedia</option>
                <option value="diadopsi">Diadopsi</option>
            </select>
            @error('status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Simpan</button>
            <a href="{{ route('admin.hewan.index') }}" class="text-gray-600 underline">Batal</a>
        </div>
    </form>
</div>
@endsection
