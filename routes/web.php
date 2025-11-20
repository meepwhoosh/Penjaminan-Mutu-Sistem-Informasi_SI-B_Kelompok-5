<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // If user is authenticated, redirect based on role; otherwise show public landing
    if (Auth::check()) {
        $role = Auth::user()->role ?? null;
        if ($role === 'admin' && Route::has('admin.dashboard')) {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'user' && Route::has('user.dashboard')) {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Role-based dashboards
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // CRUD for Hewan (admin only)
    Route::resource('hewan', App\Http\Controllers\HewanController::class);
});
