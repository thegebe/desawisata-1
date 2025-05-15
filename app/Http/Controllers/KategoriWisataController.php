<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriWisata;

class KategoriWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriWisatas = KategoriWisata::all();
        return view('kategoriwisata.index', compact('kategoriWisatas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoriwisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_wisata' => 'required|string|max:255',
        ]);

        KategoriWisata::create([
            'kategori_wisata' => $request->kategori_wisata,
        ]);

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori Wisata berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoriWisata = KategoriWisata::findOrFail($id);
        return view('kategoriwisata.edit', compact('kategoriWisata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_wisata' => 'required|string|max:255',
        ]);

        $kategoriWisata = KategoriWisata::findOrFail($id);
        $kategoriWisata->update([
            'kategori_wisata' => $request->kategori_wisata,
        ]);

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori Wisata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategoriWisata = KategoriWisata::findOrFail($id);
        $kategoriWisata->delete();

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori Wisata berhasil dihapus.');
    }
}