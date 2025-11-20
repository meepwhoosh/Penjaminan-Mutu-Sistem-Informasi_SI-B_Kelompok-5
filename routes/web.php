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

    Route::get('/user/adopsi', [App\Http\Controllers\AdopsiController::class, 'myRequests'])
        ->name('user.adopsi');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Admin resources under /admin URL and named with admin.* to avoid colliding with public routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('hewan', App\Http\Controllers\HewanController::class);
    Route::resource('adopsi', App\Http\Controllers\AdopsiController::class);
});

// Public (authenticated user) endpoint to request adoption for a specific hewan
Route::post('/hewan/{hewan}/adopsi', [App\Http\Controllers\AdopsiController::class, 'storeRequest'])
    ->middleware('auth')
    ->name('hewan.adopsi.request');

Route::get('/hewan/{hewan}/adopsi', [App\Http\Controllers\AdopsiController::class, 'requestForm'])
    ->middleware('auth')
    ->name('hewan.adopsi.form');

// Public-facing listing/show for Hewan (no auth required)
Route::get('/hewan', [App\Http\Controllers\HewanController::class, 'publicIndex'])
    ->name('hewan.index');

Route::get('/hewan/{hewan}', [App\Http\Controllers\HewanController::class, 'publicShow'])
    ->name('hewan.show');
