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

        if ($this->isAcceptedStatus($data['status']) && $this->hasActiveAdoption($data['hewan_id'])) {
            return back()->withErrors(['hewan_id' => 'Hewan sudah memiliki adopsi aktif.'])->withInput();
        }

        $adopsi = Adopsi::create($data);
        $this->syncHewanStatus($adopsi->hewan, $adopsi->status);

        return redirect()->route('admin.adopsi.index')->with('status', 'Adopsi berhasil dibuat.');
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
        $oldHewanId = $adopsi->hewan_id;
        $data = $request->validated();

        if ($this->isAcceptedStatus($data['status']) && $this->hasActiveAdoption($data['hewan_id'], $adopsi->id)) {
            return back()->withErrors(['hewan_id' => 'Hewan sudah memiliki adopsi aktif.'])->withInput();
        }

        $adopsi->update($data);

        // Sync new hewan status
        $this->syncHewanStatus($adopsi->hewan, $adopsi->status);

        // If hewan changed, release previous hewan if no other active adopsi
        if ($oldHewanId !== $adopsi->hewan_id) {
            $this->refreshHewanAvailability($oldHewanId);
        }

        return redirect()->route('admin.adopsi.index')->with('status', 'Adopsi berhasil diperbarui.');
    }

    public function destroy(Adopsi $adopsi): RedirectResponse
    {
        $hewanId = $adopsi->hewan_id;
        $adopsi->delete();

        $this->refreshHewanAvailability($hewanId);

        return redirect()->route('admin.adopsi.index')->with('status', 'Adopsi berhasil dihapus.');
    }

    /**
     * Form permintaan adopsi untuk user.
     */
    public function requestForm(Hewan $hewan): View
    {
        $user = Auth::user();
        $isAdmin = $user && $user->role === 'admin';

        if ($hewan->status !== 'tersedia' && ! $isAdmin) {
            abort(404);
        }

        return view('adopsi.request', compact('hewan'));
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

        $validated = $request->validate([
            'tanggal_adopsi' => ['nullable', 'date'],
        ]);

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
            'tanggal_adopsi' => $validated['tanggal_adopsi'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('user.adopsi')->with('status', 'Permintaan adopsi berhasil dikirim.');
    }

    /**
     * Tampilkan daftar adopsi milik user yang login.
     */
    public function myRequests(): View
    {
        $user = Auth::user();
        $adopsi = Adopsi::with('hewan')
            ->where('user_id', optional($user)->id)
            ->latest()
            ->paginate(10);

        return view('user.adopsi', compact('adopsi'));
    }

    /**
     * Sesuaikan status hewan berdasarkan status adopsi.
     */
    protected function syncHewanStatus(Hewan $hewan, string $status): void
    {
        if (in_array($status, ['diterima', 'selesai'])) {
            $hewan->update(['status' => 'diadopsi']);
        } else {
            $hasActiveAdoption = $this->hasActiveAdoption($hewan->id);

            if (! $hasActiveAdoption) {
                $hewan->update(['status' => 'tersedia']);
            }
        }
    }

    /**
     * Kembalikan hewan ke tersedia jika tidak ada adopsi aktif diterima/selesai.
     */
    protected function refreshHewanAvailability(int $hewanId): void
    {
        $hewan = Hewan::find($hewanId);
        if (! $hewan) {
            return;
        }

        $hasActiveAdoption = Adopsi::where('hewan_id', $hewanId)
            ->whereIn('status', ['diterima', 'selesai'])
            ->exists();

        if (! $hasActiveAdoption && $hewan->status !== 'tersedia') {
            $hewan->update(['status' => 'tersedia']);
        }
    }

    /**
     * Periksa apakah hewan memiliki adopsi diterima/selesai (kecuali id tertentu).
     */
    protected function hasActiveAdoption(int $hewanId, ?int $exceptAdopsiId = null): bool
    {
        $query = Adopsi::where('hewan_id', $hewanId)
            ->whereIn('status', ['diterima', 'selesai']);

        if ($exceptAdopsiId) {
            $query->where('id', '!=', $exceptAdopsiId);
        }

        return $query->exists();
    }

    protected function isAcceptedStatus(string $status): bool
    {
        return in_array($status, ['diterima', 'selesai'], true);
    }
}
