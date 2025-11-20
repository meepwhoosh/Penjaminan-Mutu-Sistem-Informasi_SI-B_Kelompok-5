@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl p-6 md:p-8 flex items-center justify-between shadow-lg mb-8">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] opacity-80">Pengajuan</p>
            <h1 class="text-3xl font-bold">Ajukan Adopsi</h1>
            <p class="text-sm opacity-90">Lengkapi form singkat sebelum mengajukan.</p>
        </div>
        <a href="{{ route('hewan.show', $hewan) }}" class="text-white underline text-sm">Kembali</a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-white p-6 md:p-8 rounded-xl shadow border border-gray-100">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-500">Hewan yang dipilih</p>
                    <p class="font-semibold text-xl">{{ $hewan->nama }}</p>
                    <p class="text-sm text-gray-600">{{ $hewan->jenis }} - {{ $hewan->ras ?? '-' }}</p>
                </div>
                <x-status-badge :status="$hewan->status" />
            </div>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('hewan.adopsi.request', $hewan) }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-semibold">Tanggal rencana adopsi</label>
                    <input type="date" name="tanggal_adopsi" value="{{ old('tanggal_adopsi') }}" class="border p-3 w-full rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-sm text-gray-500">Opsional, sebagai preferensi jadwal Anda bertemu hewan.</p>
                    @error('tanggal_adopsi')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex gap-3 items-center">
                    <button type="submit" class="inline-flex items-center bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500">
                        Kirim Permohonan
                    </button>
                    <a href="{{ route('hewan.show', $hewan) }}" class="text-gray-600 underline">Batal</a>
                </div>
            </form>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
                <p class="text-sm font-semibold mb-2">Tips sebelum mengajukan</p>
                <ul class="text-sm text-gray-700 list-disc list-inside space-y-1">
                    <li>Pilih tanggal yang Anda bisa hadir.</li>
                    <li>Pastikan keluarga setuju dengan adopsi.</li>
                    <li>Siapkan ruang nyaman untuk hewan di rumah.</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
                <p class="text-sm font-semibold mb-2">Status hewan</p>
                <p class="text-sm text-gray-700">Kami akan menghubungi Anda setelah permohonan diterima. Hewan akan tetap berstatus tersedia sampai disetujui admin.</p>
            </div>
        </div>
    </div>
</div>
@endsection
