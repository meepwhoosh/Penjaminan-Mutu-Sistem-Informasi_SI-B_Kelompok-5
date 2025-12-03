@extends('layouts.app')

@section('content')
<div class="w-full bg-gray-50 pb-16 mt-28">

    {{-- ==== FILTER SECTION ==== --}}
    <div class="w-full flex justify-center items-center mt-8 gap-6">

        {{-- Dog & Cat Filter --}}
        <form method="GET" class="flex gap-4">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="usia" value="{{ request('usia') }}">
            
            {{-- Dog --}}
            <button type="submit" name="jenis" value="anjing" 
                class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition {{ request('jenis') == 'anjing' ? 'text-blue-700' : '' }}">
                <div class="w-16 h-16 border-2 {{ request('jenis') == 'anjing' ? 'border-blue-700' : 'border-gray-400' }} rounded-lg flex items-center justify-center text-3xl hover:border-gray-600">
                    🐶
                </div>
                <span class="text-sm mt-2 font-medium">Dog</span>
            </button>

            {{-- Cat --}}
            <button type="submit" name="jenis" value="kucing"
                class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition {{ request('jenis') == 'kucing' ? 'text-blue-700' : '' }}">
                <div class="w-16 h-16 border-2 {{ request('jenis') == 'kucing' ? 'border-blue-700' : 'border-gray-400' }} rounded-lg flex items-center justify-center text-3xl hover:border-gray-600">
                    🐱
                </div>
                <span class="text-sm mt-2 font-medium">Cat</span>
            </button>
        </form>

        {{-- Gender & Age Filter --}}
        <form class="flex gap-3" method="GET">
            <input type="hidden" name="jenis" value="{{ request('jenis') }}">
            
            <select name="gender" class="px-8 py-2.5 rounded-full border-2 border-gray-300 bg-yellow-400 text-gray-800 font-medium shadow-sm focus:outline-none focus:border-yellow-500">
                <option value="">Gender</option>
                <option value="jantan" {{ request('gender') == 'jantan' ? 'selected' : '' }}>Male</option>
                <option value="betina" {{ request('gender') == 'betina' ? 'selected' : '' }}>Female</option>
            </select>

            <select name="usia" class="px-8 py-2.5 rounded-full border-2 border-gray-300 bg-yellow-400 text-gray-800 font-medium shadow-sm focus:outline-none focus:border-yellow-500">
                <option value="">Age</option>
                <option value="1" {{ request('usia') == '1' ? 'selected' : '' }}>1 year</option>
                <option value="2" {{ request('usia') == '2' ? 'selected' : '' }}>2 years</option>
                <option value="3" {{ request('usia') == '3' ? 'selected' : '' }}>3 years</option>
                <option value="4" {{ request('usia') == '4' ? 'selected' : '' }}>4 years</option>
                <option value="5" {{ request('usia') == '5' ? 'selected' : '' }}>5+ years</option>
            </select>

            <button type="submit"
                class="px-8 py-2.5 bg-blue-700 text-white rounded-full shadow-md hover:bg-blue-800 font-medium transition">
                Find
            </button>
            
            @if(request()->hasAny(['jenis', 'gender', 'usia']))
            <a href="{{ route('hewan.index') }}"
                class="px-8 py-2.5 bg-gray-500 text-white rounded-full shadow-md hover:bg-gray-600 font-medium transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    {{-- ==== PETS LIST ==== --}}
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12 px-4">

        @forelse($hewan as $h)
        <div class="bg-yellow-400 rounded-2xl p-3 shadow-lg border-2 border-yellow-500 hover:shadow-xl transition">
            <div class="w-full h-44 rounded-xl overflow-hidden bg-white">
                @if($h->foto)
                <img src="{{ asset('images/'.$h->foto) }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    No Image
                </div>
                @endif
            </div>

            <div class="mt-3">
                <h2 class="text-lg font-bold text-gray-900">{{ $h->nama }}</h2>
                
                <div class="flex items-center gap-1.5 mt-1">
                    <span class="text-blue-900">{{ $h->gender == 'jantan' ? '♂' : '♀' }}</span>
                    <span class="text-sm text-gray-800">{{ $h->usia ?? '-' }}</span>
                </div>

                <div class="flex items-center gap-1.5 mt-1">
                    <span class="text-gray-800">🐾</span>
                    <span class="text-sm text-gray-800">{{ $h->ras ?? $h->jenis }}</span>
                </div>
            </div>
            
            <a href="{{ route('hewan.show', $h) }}"
                class="block mt-3 text-center bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                View Details
            </a>
        </div>
        @empty
        <div class="col-span-4 text-center py-10">
            <p class="text-gray-600 text-lg">No pets found matching your criteria.</p>
            <a href="{{ route('hewan.index') }}" class="text-blue-700 font-semibold hover:underline mt-2 inline-block">
                Clear filters
            </a>
        </div>
        @endforelse

    </div>

    <div class="w-full text-center mt-10 mb-8">
        {{ $hewan->links() }}
    </div>

</div>
@endsection