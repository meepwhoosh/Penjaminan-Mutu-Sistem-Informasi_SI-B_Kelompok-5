@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Adopsi</h1>

    <form action="{{ route('adopsi.update', $adopsi) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium">Pemohon</label>
            <select name="user_id" class="mt-1 block w-full">
                @foreach($users as $u)
                    <option value="{{ $u->id }}" @if($u->id == $adopsi->user_id) selected @endif>{{ $u->name ?? $u->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Hewan</label>
            <select name="hewan_id" class="mt-1 block w-full">
                @foreach($hewan as $h)
                    <option value="{{ $h->id }}" @if($h->id == $adopsi->hewan_id) selected @endif>{{ $h->nama }} ({{ $h->jenis }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Tanggal Adopsi</label>
            <input type="date" name="tanggal_adopsi" value="{{ $adopsi->tanggal_adopsi }}" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="mt-1 block w-full">
                <option value="pending" @if($adopsi->status=='pending') selected @endif>pending</option>
                <option value="diterima" @if($adopsi->status=='diterima') selected @endif>diterima</option>
                <option value="selesai" @if($adopsi->status=='selesai') selected @endif>selesai</option>
                <option value="ditolak" @if($adopsi->status=='ditolak') selected @endif>ditolak</option>
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
