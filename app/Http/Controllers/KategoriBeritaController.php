<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBerita;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriBeritas = KategoriBerita::all();
        return view('kategoriberita.index', compact('kategoriBeritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoriberita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_berita' => 'required|string|max:255',
        ]);

        KategoriBerita::create([
            'kategori_berita' => $request->kategori_berita,
        ]);

        return redirect()->route('kategoriberita.index')->with('success', 'Kategori Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoriBerita = KategoriBerita::findOrFail($id);
        return view('kategoriberita.edit', compact('kategoriBerita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_berita' => 'required|string|max:255',
        ]);

        $kategoriBerita = KategoriBerita::findOrFail($id);
        $kategoriBerita->update([
            'kategori_berita' => $request->kategori_berita,
        ]);

        return redirect()->route('kategoriberita.index')->with('success', 'Kategori Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriBerita = KategoriBerita::findOrFail($id);
        $kategoriBerita->delete();

        return redirect()->route('kategoriberita.index')->with('success', 'Kategori Berita berhasil dihapus.');
    }
}
