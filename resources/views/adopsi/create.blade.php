@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Adopsi</h1>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.adopsi.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Pemohon</label>
            <select name="user_id" class="mt-1 block w-full border p-2 rounded">
                <option value="">-- Pilih User --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->name ?? $u->nama }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Hewan</label>
            <select name="hewan_id" class="mt-1 block w-full border p-2 rounded">
                <option value="">-- Pilih Hewan --</option>
                @foreach($hewan as $h)
                    <option value="{{ $h->id }}" @selected(old('hewan_id') == $h->id)>{{ $h->nama }} ({{ $h->jenis }})</option>
                @endforeach
            </select>
            @error('hewan_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Tanggal Adopsi</label>
            <input type="date" name="tanggal_adopsi" value="{{ old('tanggal_adopsi') }}" class="mt-1 block w-full border p-2 rounded">
            @error('tanggal_adopsi')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="mt-1 block w-full border p-2 rounded">
                @foreach(['pending','diterima','selesai','ditolak'] as $status)
                    <option value="{{ $status }}" @selected(old('status') === $status || (old('status') === null && $status === 'pending'))>{{ $status }}</option>
                @endforeach
            </select>
            @error('status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-2 items-center">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.adopsi.index') }}" class="text-gray-600 underline">Kembali</a>
        </div>
    </form>
</div>
@endsection
