@props(['status'])

@php
    $status = strtolower((string) $status);
    $classes = match ($status) {
        'tersedia' => 'bg-green-100 text-green-800',
        'diadopsi' => 'bg-gray-200 text-gray-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
        'diterima' => 'bg-green-100 text-green-800',
        'selesai' => 'bg-blue-100 text-blue-800',
        'ditolak' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {$classes}"]) }}>
    {{ ucfirst($status) }}
</span>
