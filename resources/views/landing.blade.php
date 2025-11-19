@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-4">Welcome to PawCare</h1>
        <p class="text-gray-700 mb-6">Selamat datang di PawCare. Sistem ini membantu pengelolaan adopsi hewan peliharaan.</p>

        <div class="space-x-3">
            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Login</a>
            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Register</a>
        </div>
    </div>
</div>
@endsection
