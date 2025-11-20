@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Adopsi</h1>

    <form action="{{ route('adopsi.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Pemohon</label>
            <select name="user_id" class="mt-1 block w-full">
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name ?? $u->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Hewan</label>
            <select name="hewan_id" class="mt-1 block w-full">
                @foreach($hewan as $h)
                    <option value="{{ $h->id }}">{{ $h->nama }} ({{ $h->jenis }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Tanggal Adopsi</label>
            <input type="date" name="tanggal_adopsi" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="mt-1 block w-full">
                <option value="pending">pending</option>
                <option value="diterima">diterima</option>
                <option value="selesai">selesai</option>
                <option value="ditolak">ditolak</option>
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
