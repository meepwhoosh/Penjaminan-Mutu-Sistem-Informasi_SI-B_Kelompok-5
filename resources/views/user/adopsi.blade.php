@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Permintaan Adopsi Saya</h1>
        <a href="{{ route('user.dashboard') }}" class="text-gray-600 underline">Kembali ke dashboard</a>
    </div>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    @if($adopsi->isEmpty())
        <p class="text-gray-600">Belum ada permintaan adopsi.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Hewan</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adopsi as $a)
                        <tr>
                            <td class="p-2 border">
                                {{ $a->hewan->nama ?? '-' }}
                            </td>
                            <td class="p-2 border">{{ $a->status }}</td>
                            <td class="p-2 border">{{ $a->tanggal_adopsi ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $adopsi->links() }}
        </div>
    @endif
</div>
@endsection
