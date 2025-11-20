<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdopsiRequest;
use App\Models\Adopsi;
use App\Models\Hewan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdopsiController extends Controller
{
    public function index(): View
    {
        $adopsi = Adopsi::with(['user', 'hewan'])->latest()->paginate(12);

        return view('adopsi.index', compact('adopsi'));
    }

    public function create(): View
    {
        $users = User::all();
        $hewan = Hewan::where('status', 'tersedia')->get();

        return view('adopsi.create', compact('users', 'hewan'));
    }

    public function store(AdopsiRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Adopsi::create($data);

        return redirect()->route('adopsi.index')->with('status', 'Adopsi berhasil dibuat.');
    }

    public function show(Adopsi $adopsi): View
    {
        $adopsi->load(['user', 'hewan']);
        return view('adopsi.show', compact('adopsi'));
    }

    public function edit(Adopsi $adopsi): View
    {
        $users = User::all();
        $hewan = Hewan::all();
        return view('adopsi.edit', compact('adopsi', 'users', 'hewan'));
    }

    public function update(AdopsiRequest $request, Adopsi $adopsi): RedirectResponse
    {
        $data = $request->validated();
        $adopsi->update($data);

        return redirect()->route('adopsi.index')->with('status', 'Adopsi berhasil diperbarui.');
    }

    public function destroy(Adopsi $adopsi): RedirectResponse
    {
        $adopsi->delete();

        return redirect()->route('adopsi.index')->with('status', 'Adopsi berhasil dihapus.');
    }

    /**
     * Store an adoption request from an authenticated user for a specific Hewan.
     */
    public function storeRequest(Request $request, Hewan $hewan): RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Only request if hewan is available
        if ($hewan->status !== 'tersedia') {
            return redirect()->back()->withErrors(['hewan' => 'Hewan tidak tersedia untuk adopsi.']);
        }

        // Prevent duplicate pending/diterima requests from same user for same hewan
        $exists = Adopsi::where('user_id', $user->id)
            ->where('hewan_id', $hewan->id)
            ->whereIn('status', ['pending', 'diterima'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('status', 'Anda sudah mengajukan permintaan adopsi untuk hewan ini.');
        }

        Adopsi::create([
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => null,
            'status' => 'pending',
        ]);

        return redirect()->route('hewan.show', $hewan)->with('status', 'Permintaan adopsi berhasil dikirim.');
    }
}
