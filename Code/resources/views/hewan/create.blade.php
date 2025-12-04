@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Admin</p>
            <h1 class="text-3xl font-bold text-blue-900">Tambah Hewan</h1>
            <p class="text-sm text-gray-600">Masukkan informasi hewan baru.</p>
        </div>
        <a href="{{ route('admin.hewan.index') }}" class="text-blue-700 font-semibold hover:underline">← Kembali</a>
    </div>

    @if($errors->any())
        <div class="mb-4 text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hewan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl shadow border border-gray-100 space-y-4">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Milo">
            @error('nama')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Jenis</label>
            <div class="relative">
                <select name="jenis" class="border-2 border-blue-200 p-3 w-full rounded-full bg-white text-blue-900 font-semibold pr-10 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Pilih jenis</option>
                    <option value="kucing" {{ old('jenis') === 'kucing' ? 'selected' : '' }}>Kucing</option>
                    <option value="anjing" {{ old('jenis') === 'anjing' ? 'selected' : '' }}>Anjing</option>
                </select>
                <svg class="w-4 h-4 text-blue-700 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
            </div>
            @error('jenis')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Ras</label>
            <input type="text" name="ras" value="{{ old('ras') }}" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Persia / Bulldog">
            @error('ras')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Warna</label>
            <input type="text" name="warna" value="{{ old('warna') }}" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Cokelat, Hitam Putih">
            @error('warna')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Kepribadian</label>
            <input type="text" name="kepribadian" value="{{ old('kepribadian') }}" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Ramah, Aktif, Tenang">
            @error('kepribadian')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 focus:ring-2 focus:ring-blue-500 focus:outline-none" rows="4" placeholder="Ceritakan karakter hewan...">{{ old('deskripsi') }}</textarea>
            <p class="text-sm text-gray-500 mt-1">Opsional. Maks 1000 karakter.</p>
            @error('deskripsi')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Usia</label>
            <input type="text" name="usia" value="{{ old('usia') }}" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: 2 years / 6 months">
            @error('usia')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Gender</label>
            <div class="relative">
                <select name="gender" class="border-2 border-blue-200 p-3 w-full rounded-full bg-white text-blue-900 font-semibold pr-10 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Pilih gender</option>
                    <option value="jantan" {{ old('gender') === 'jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="betina" {{ old('gender') === 'betina' ? 'selected' : '' }}>Betina</option>
                </select>
                <svg class="w-4 h-4 text-blue-700 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
            </div>
            @error('gender')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Foto</label>
            <input type="file" name="foto" class="border-2 border-blue-200 p-3 w-full rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <p class="text-sm text-gray-500 mt-1">Format jpg/jpeg/png/webp, maks 5 MB.</p>
            @error('foto')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Status</label>
            <div class="relative">
                <select name="status" class="border-2 border-blue-200 p-3 w-full rounded-full bg-white text-blue-900 font-semibold pr-10 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="tersedia">Tersedia</option>
                    <option value="diadopsi">Diadopsi</option>
                </select>
                <svg class="w-4 h-4 text-blue-700 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
            </div>
            @error('status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-3 items-center pt-2">
            <button type="submit" class="bg-blue-700 text-white px-5 py-2 rounded-full shadow hover:bg-blue-800 transition">Simpan</button>
            <a href="{{ route('admin.hewan.index') }}" class="text-blue-700 font-semibold hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
