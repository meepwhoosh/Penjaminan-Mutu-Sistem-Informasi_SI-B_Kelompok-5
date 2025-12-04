@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Admin</p>
            <h1 class="text-3xl font-bold text-blue-900">Edit Adopsi</h1>
            <p class="text-sm text-gray-600">Ubah pemohon, hewan, dan status adopsi.</p>
        </div>
        <a href="{{ route('admin.adopsi.index') }}" class="text-blue-700 font-semibold hover:underline">← Kembali</a>
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

    <form action="{{ route('admin.adopsi.update', $adopsi) }}" method="POST" class="bg-white p-6 rounded-2xl shadow border border-gray-100 space-y-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Pemohon</label>
            <div class="relative">
            <select name="user_id" class="mt-1 block w-full border-2 border-blue-200 p-3 rounded-full bg-white font-semibold text-blue-900 pr-10 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" @if($u->id == $adopsi->user_id) selected @endif>{{ $u->name ?? $u->nama }}</option>
                @endforeach
            </select>
            <svg class="w-4 h-4 text-blue-700 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
            </svg>
            </div>
            @error('user_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Hewan</label>
            <div class="relative">
            <select name="hewan_id" class="mt-1 block w-full border-2 border-blue-200 p-3 rounded-full bg-white font-semibold text-blue-900 pr-10 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                @foreach($hewan as $h)
                    <option value="{{ $h->id }}" @if($h->id == $adopsi->hewan_id) selected @endif>{{ $h->nama }} ({{ $h->jenis }})</option>
                @endforeach
            </select>
            <svg class="w-4 h-4 text-blue-700 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
            </svg>
            </div>
            @error('hewan_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Tanggal Adopsi</label>
            <input type="date" name="tanggal_adopsi" value="{{ $adopsi->tanggal_adopsi }}" class="mt-1 block w-full border-2 border-blue-200 p-3 rounded-xl bg-white text-blue-900 font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('tanggal_adopsi')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Status</label>
            <div class="relative">
            <select name="status" class="mt-1 block w-full border-2 border-blue-200 p-3 rounded-full bg-white font-semibold text-blue-900 pr-10 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="pending" @if($adopsi->status=='pending') selected @endif>pending</option>
                <option value="diterima" @if($adopsi->status=='diterima') selected @endif>diterima</option>
                <option value="selesai" @if($adopsi->status=='selesai') selected @endif>selesai</option>
                <option value="ditolak" @if($adopsi->status=='ditolak') selected @endif>ditolak</option>
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
            <a href="{{ route('admin.adopsi.index') }}" class="text-blue-700 font-semibold hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
