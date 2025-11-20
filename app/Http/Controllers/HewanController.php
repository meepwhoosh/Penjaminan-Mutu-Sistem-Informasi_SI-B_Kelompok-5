<?php

namespace App\Http\Controllers;

use App\Http\Requests\HewanRequest;
use App\Models\Hewan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HewanController extends Controller
{
    public function index(): View
    {
        $hewan = Hewan::latest()->paginate(12);

        return view('hewan.index', compact('hewan'));
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

        return redirect()->route('hewan.index')->with('status', 'Hewan berhasil ditambahkan.');
    }

    public function show(Hewan $hewan): View
    {
        return view('hewan.show', compact('hewan'));
    }

    public function edit(Hewan $hewan): View
    {
        return view('hewan.edit', compact('hewan'));
    }

    public function update(HewanRequest $request, Hewan $hewan): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('hewan', 'public');
            $data['foto'] = $path;
        }

        $hewan->update($data);

        return redirect()->route('hewan.index')->with('status', 'Hewan berhasil diperbarui.');
    }

    public function destroy(Hewan $hewan): RedirectResponse
    {
        $hewan->delete();

        return redirect()->route('hewan.index')->with('status', 'Hewan berhasil dihapus.');
    }
}
