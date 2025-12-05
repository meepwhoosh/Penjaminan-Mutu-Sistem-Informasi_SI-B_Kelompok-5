<?php

namespace App\Http\Controllers;

use App\Http\Requests\HewanRequest;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HewanController extends Controller
{
    public function index(Request $request): View
    {
        $query = Hewan::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%'.$search.'%')
                  ->orWhere('ras', 'like', '%'.$search.'%')
                  ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $hewan = $query->latest()->paginate(12)->withQueryString();
        return view('hewan.admin.index', compact('hewan'));
    }

    public function create(): View
    {
        return view('hewan.create');
    }

    public function publicIndex(Request $request)
    {
        $query = Hewan::query()->where('status', 'tersedia');

        // Filter by jenis (Dog/Cat)
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by age
        if ($request->filled('usia')) {
            $usia = $request->usia;
            
            // Karena usia dalam format string "2 years", "5 months", dll
            // Kita cari yang dimulai dengan angka tersebut
            if ($usia == '5') {
                // 5+ years - cari yang >= 5
                $query->where(function($q) {
                    $q->where('usia', 'like', '5%')
                      ->orWhere('usia', 'like', '6%')
                      ->orWhere('usia', 'like', '7%')
                      ->orWhere('usia', 'like', '8%')
                      ->orWhere('usia', 'like', '9%')
                      ->orWhere('usia', 'like', '10%');
                });
            } else {
                // Exact match - cari yang diawali dengan angka tersebut
                // Contoh: usia=2 akan match "2 years", "2,5 years", dll
                $query->where('usia', 'like', $usia.'%');
            }
        }

        $hewan = $query->paginate(12)->withQueryString();

        return view('hewan.public.index', compact('hewan'));
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
        // Eager load kesehatan untuk tampilan admin
        $hewan->load('kesehatan');
        return view('hewan.admin.show', compact('hewan'));
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
            if ($hewan->foto && Str::startsWith($hewan->foto, 'hewan/')) {
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
        if ($hewan->foto && Str::startsWith($hewan->foto, 'hewan/')) {
            Storage::disk('public')->delete($hewan->foto);
        }

        $hewan->delete();

        return redirect()->route('admin.hewan.index')->with('status', 'Hewan berhasil dihapus.');
    }
}
