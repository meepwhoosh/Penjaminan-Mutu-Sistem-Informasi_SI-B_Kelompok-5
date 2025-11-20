<?php

namespace App\Http\Controllers;

use App\Http\Requests\HewanRequest;
use App\Models\Hewan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HewanController extends Controller
{
    public function index(): View
    {
        $hewan = Hewan::latest()->paginate(12);

        return view('hewan.admin.index', compact('hewan'));
    }

    public function create(): View
    {
        return view('hewan.create');
    }

    public function store(HewanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('hewan', 'public');
            $data['foto'] = $path;
        }

        Hewan::create($data);

        return redirect()->route('admin.hewan.index')->with('status', 'Hewan berhasil ditambahkan.');
    }

    public function show(Hewan $hewan): View
    {
        return view('hewan.admin.show', compact('hewan'));
    }

    /**
     * Public listing for available hewan (visible to all users).
     */
    public function publicIndex(): View
    {
        $query = Hewan::where('status', 'tersedia');

        if ($search = request('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jenis', 'like', "%{$search}%")
                    ->orWhere('ras', 'like', "%{$search}%");
            });
        }

        if ($jenis = request('jenis')) {
            $query->where('jenis', $jenis);
        }

        $hewan = $query->latest()->paginate(12)->withQueryString();

        return view('hewan.public.index', compact('hewan'));
    }

    /**
     * Public show for a single hewan.
     */
    public function publicShow(Hewan $hewan): View
    {
        // only allow viewing if the hewan is available or user is admin
        $isAdmin = Auth::check() && Auth::user()->role === 'admin';
        if ($hewan->status !== 'tersedia' && ! $isAdmin) {
            abort(404);
        }

        return view('hewan.public.show', compact('hewan'));
    }

    public function edit(Hewan $hewan): View
    {
        return view('hewan.edit', compact('hewan'));
    }

    public function update(HewanRequest $request, Hewan $hewan): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($hewan->foto) {
                Storage::disk('public')->delete($hewan->foto);
            }

            $path = $request->file('foto')->store('hewan', 'public');
            $data['foto'] = $path;
        }

        $hewan->update($data);

        return redirect()->route('admin.hewan.index')->with('status', 'Hewan berhasil diperbarui.');
    }

    public function destroy(Hewan $hewan): RedirectResponse
    {
        // hapus foto di storage jika ada
        if ($hewan->foto) {
            Storage::disk('public')->delete($hewan->foto);
        }

        $hewan->delete();

        return redirect()->route('admin.hewan.index')->with('status', 'Hewan berhasil dihapus.');
    }
}
