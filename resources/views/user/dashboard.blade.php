@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 space-y-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl p-6 md:p-8 shadow">
            <p class="text-xs uppercase tracking-[0.2em] opacity-80">Dashboard User</p>
            <h1 class="text-3xl font-bold">Selamat datang di PawCare</h1>
            <p class="mt-2 text-sm opacity-90">Cari hewan yang cocok dan ajukan adopsi dengan mudah.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('hewan.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-white text-emerald-700 font-semibold shadow hover:bg-emerald-50">Lihat Hewan</a>
                <a href="{{ route('user.adopsi') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-emerald-500 text-white font-semibold shadow hover:bg-emerald-600">Adopsi Saya</a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-white text-emerald-700 font-semibold shadow hover:bg-emerald-50">Dashboard Umum</a>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
                <p class="text-sm font-semibold text-gray-700">Mulai Adopsi</p>
                <p class="text-sm text-gray-600 mt-2">Kunjungi daftar hewan, pilih yang tersedia, lalu isi form pengajuan.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
                <p class="text-sm font-semibold text-gray-700">Pantau Status</p>
                <p class="text-sm text-gray-600 mt-2">Cek halaman “Adopsi Saya” untuk melihat permohonan pending/diterima/ditolak.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
                <p class="text-sm font-semibold text-gray-700">Tips</p>
                <ul class="text-sm text-gray-600 list-disc list-inside space-y-1 mt-2">
                    <li>Sertakan tanggal kunjungan yang pas.</li>
                    <li>Siapkan tempat nyaman di rumah.</li>
                    <li>Hubungi admin jika butuh bantuan.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
