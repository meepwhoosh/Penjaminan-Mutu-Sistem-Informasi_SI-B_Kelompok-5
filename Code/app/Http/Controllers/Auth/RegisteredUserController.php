<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'], // Ganti 'name' jadi ini
            'last_name'  => ['required', 'string', 'max:255'], // Tambah ini
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Gabungkan Nama Depan & Belakang
        $fullName = $request->first_name . ' ' . $request->last_name;

        // 3. Buat User
        $user = User::create([
            'first_name'     => $fullName, // Simpan gabungan nama
            'last_name'      => $request->last_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }
}