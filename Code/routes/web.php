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
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Logic login akan ditambahkan nanti
    return redirect()->back()->with('error', 'Login functionality not implemented yet');
})->name('login.post');

// Halaman Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // Logic register akan ditambahkan nanti
    return redirect()->back()->with('error', 'Register functionality not implemented yet');
})->name('register.post');

// Forgot Password
Route::get('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Terms & Privacy
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// Social Login - Google
Route::get('/login/google', function () {
    return redirect()->back()->with('info', 'Google login not implemented yet');
})->name('login.google');

Route::get('/register/google', function () {
    return redirect()->back()->with('info', 'Google register not implemented yet');
})->name('register.google');

// Social Login - Facebook
Route::get('/login/facebook', function () {
    return redirect()->back()->with('info', 'Facebook login not implemented yet');
})->name('login.facebook');

Route::get('/register/facebook', function () {
    return redirect()->back()->with('info', 'Facebook register not implemented yet');
})->name('register.facebook');

// Social Login - Apple
Route::get('/login/apple', function () {
    return redirect()->back()->with('info', 'Apple login not implemented yet');
})->name('login.apple');

Route::get('/register/apple', function () {
    return redirect()->back()->with('info', 'Apple register not implemented yet');
})->name('register.apple');

// Homepage (optional)
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/pets', function () {
    return view('pets');
})->name('pets');

Route::get('/about', function () {
    return view('about');
})->name('about');

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
