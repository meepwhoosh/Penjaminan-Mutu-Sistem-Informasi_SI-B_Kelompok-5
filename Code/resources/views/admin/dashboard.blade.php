@extends('layouts.app')

@section('content')
@php
    use App\Models\Hewan;
    use App\Models\Adopsi;
    use App\Models\User;

    $totalHewan = Hewan::count();
    $tersedia = Hewan::where('status', 'tersedia')->count();
    $diadopsi = Hewan::where('status', 'diadopsi')->count();
    $pending = Adopsi::where('status', 'pending')->count();
    $diterima = Adopsi::where('status', 'diterima')->count();
    $selesai = Adopsi::where('status', 'selesai')->count();
    $recentAdopsi = Adopsi::with(['user', 'hewan'])->latest()->take(5)->get();
@endphp

<div class="max-w-6xl mx-auto py-10 space-y-8 px-4 mt-12 md:mt-14">
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-2xl p-6 md:p-8 shadow">
        <p class="text-xs uppercase tracking-[0.2em] opacity-80">Dashboard Admin</p>
        <h1 class="text-3xl font-bold">PawCare Control Center</h1>
        <p class="mt-2 text-sm opacity-90">Kelola hewan, adopsi, dan data pengguna dengan cepat.</p>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('admin.hewan.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-full bg-white text-indigo-700 font-semibold shadow hover:bg-indigo-50 transition">
                Daftar Hewan
            </a>
            <a href="{{ route('admin.hewan.create') }}" class="inline-flex items-center px-5 py-2.5 rounded-full bg-white text-indigo-700 font-semibold shadow hover:bg-indigo-50 transition">
                + Tambah Hewan
            </a>
            <a href="{{ route('admin.adopsi.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-full bg-white text-indigo-700 font-semibold shadow hover:bg-indigo-50 transition">
                Manajemen Adopsi
            </a>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Hewan</p>
            <div class="mt-2 flex items-end gap-2">
                <span class="text-3xl font-bold text-blue-900">{{ $totalHewan }}</span>
                <span class="text-sm text-gray-500">total</span>
            </div>
            <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                <div class="bg-blue-50 text-blue-800 rounded-lg px-3 py-2">
                    <p class="font-semibold">Tersedia</p>
                    <p>{{ $tersedia }}</p>
                </div>
                <div class="bg-yellow-50 text-yellow-800 rounded-lg px-3 py-2">
                    <p class="font-semibold">Diadopsi</p>
                    <p>{{ $diadopsi }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Adopsi</p>
            <div class="mt-2 grid grid-cols-3 gap-2 text-sm">
                <div class="bg-gray-50 text-gray-800 rounded-lg px-3 py-2">
                    <p class="font-semibold">Pending</p>
                    <p>{{ $pending }}</p>
                </div>
                <div class="bg-green-50 text-green-800 rounded-lg px-3 py-2">
                    <p class="font-semibold">Diterima</p>
                    <p>{{ $diterima }}</p>
                </div>
                <div class="bg-blue-50 text-blue-800 rounded-lg px-3 py-2">
                    <p class="font-semibold">Selesai</p>
                    <p>{{ $selesai }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 border border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Navigasi Cepat</p>
            <div class="mt-3 space-y-2">
                <a href="{{ route('admin.hewan.index') }}" class="block text-blue-700 hover:underline font-semibold">Kelola Hewan</a>
                <a href="{{ route('admin.adopsi.index') }}" class="block text-blue-700 hover:underline font-semibold">Kelola Adopsi</a>
                <a href="{{ route('admin.hewan.create') }}" class="block text-blue-700 hover:underline font-semibold">Tambah Hewan</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-4 border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-gray-700">Adopsi Terbaru</p>
            <a href="{{ route('admin.adopsi.index') }}" class="text-sm text-blue-700 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-blue-50 text-sm text-blue-900">
                        <th class="p-3 border-b">User</th>
                        <th class="p-3 border-b">Hewan</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAdopsi as $a)
                        <tr class="hover:bg-blue-50/60 text-sm">
                            <td class="p-3 border-b">{{ $a->user->first_name ?? 'User' }}</td>
                            <td class="p-3 border-b">{{ $a->hewan->nama ?? '-' }}</td>
                            <td class="p-3 border-b"><x-status-badge :status="$a->status" /></td>
                            <td class="p-3 border-b">{{ $a->tanggal_adopsi ? \Carbon\Carbon::parse($a->tanggal_adopsi)->format('d M Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-gray-500">Belum ada adopsi terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
