<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdopsiRequest;
use App\Models\Adopsi;
use App\Models\Hewan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
