@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 space-y-8">
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl p-6 md:p-8 shadow">
        <p class="text-xs uppercase tracking-[0.2em] opacity-80">Dashboard Admin</p>
        <h1 class="text-3xl font-bold">PawCare Control Center</h1>
        <p class="mt-2 text-sm opacity-90">Kelola hewan, adopsi, dan pengguna dengan cepat.</p>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('admin.hewan.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-white text-indigo-700 font-semibold shadow hover:bg-indigo-50">
                Daftar Hewan
            </a>
            <a href="{{ route('admin.hewan.create') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-500 text-white font-semibold shadow hover:bg-indigo-600">
                Tambah Hewan
            </a>
            <a href="{{ route('admin.adopsi.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-white text-indigo-700 font-semibold shadow hover:bg-indigo-50">
                Manajemen Adopsi
            </a>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Tips Kilat</p>
            <ul class="text-sm text-gray-600 list-disc list-inside space-y-1 mt-2">
                <li>Periksa status hewan sebelum menyetujui adopsi.</li>
                <li>Pastikan foto jelas agar pengguna mudah memilih.</li>
                <li>Gunakan badge status untuk monitor cepat.</li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Navigasi Cepat</p>
            <div class="mt-3 space-y-2">
                <a href="{{ route('admin.hewan.index') }}" class="block text-indigo-600 hover:underline">Kelola Hewan</a>
                <a href="{{ route('admin.adopsi.index') }}" class="block text-indigo-600 hover:underline">Kelola Adopsi</a>
                <a href="{{ route('user.adopsi') }}" class="block text-indigo-600 hover:underline">Lihat Permohonan Saya</a>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Catatan</p>
            <p class="text-sm text-gray-600 mt-2">Gunakan menu di atas untuk menambah hewan baru atau tinjau permohonan adopsi terbaru. Perubahan tersimpan setelah submit.</p>
        </div>
    </div>
</div>
@endsection
