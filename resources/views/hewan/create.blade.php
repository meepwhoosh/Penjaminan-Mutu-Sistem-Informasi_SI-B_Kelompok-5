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

    <form action="{{ route('hewan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Jenis</label>
            <input type="text" name="jenis" value="{{ old('jenis') }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Ras</label>
            <input type="text" name="ras" value="{{ old('ras') }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Usia</label>
            <input type="number" name="usia" value="{{ old('usia') }}" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Foto</label>
            <input type="file" name="foto" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Status</label>
            <select name="status" class="border p-2 w-full">
                <option value="tersedia">Tersedia</option>
                <option value="diadopsi">Diadopsi</option>
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
