@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Edit Adopsi</h1>
            <p class="text-sm text-gray-600">Ubah pemohon, hewan, dan status adopsi.</p>
        </div>
        <a href="{{ route('admin.adopsi.index') }}" class="text-gray-600 underline">Kembali</a>
    </div>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.adopsi.update', $adopsi) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold">Pemohon</label>
            <select name="user_id" class="mt-1 block w-full border p-2 rounded">
                @foreach($users as $u)
                    <option value="{{ $u->id }}" @if($u->id == $adopsi->user_id) selected @endif>{{ $u->name ?? $u->nama }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold">Hewan</label>
            <select name="hewan_id" class="mt-1 block w-full border p-2 rounded">
                @foreach($hewan as $h)
                    <option value="{{ $h->id }}" @if($h->id == $adopsi->hewan_id) selected @endif>{{ $h->nama }} ({{ $h->jenis }})</option>
                @endforeach
            </select>
            @error('hewan_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold">Tanggal Adopsi</label>
            <input type="date" name="tanggal_adopsi" value="{{ $adopsi->tanggal_adopsi }}" class="mt-1 block w-full border p-2 rounded">
            @error('tanggal_adopsi')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold">Status</label>
            <select name="status" class="mt-1 block w-full border p-2 rounded">
                <option value="pending" @if($adopsi->status=='pending') selected @endif>pending</option>
                <option value="diterima" @if($adopsi->status=='diterima') selected @endif>diterima</option>
                <option value="selesai" @if($adopsi->status=='selesai') selected @endif>selesai</option>
                <option value="ditolak" @if($adopsi->status=='ditolak') selected @endif>ditolak</option>
            </select>
            @error('status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-2 items-center">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
