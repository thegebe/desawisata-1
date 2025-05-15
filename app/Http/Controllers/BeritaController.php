<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('kategoriBerita')->get();
        return view('berita.index', [
            'title' => 'Admin',
            'menu' => 'Berita',
            'beritas' => $beritas,
        ]);
    }

    public function create()
    {
        $kategoriBeritas = KategoriBerita::all();
        return view('berita.create', [
            'title' => 'Admin',
            'menu' => 'Berita',
            'kategoriBeritas' => $kategoriBeritas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'berita' => 'required|string',
            'tgl_post' => 'required|date',
            'id_kategori_beritas' => 'required|exists:kategori_beritas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('berita', 'public') : null;

        Berita::create([
            'judul' => $request->judul,
            'berita' => $request->berita,
            'tgl_post' => $request->tgl_post,
            'id_kategori_beritas' => $request->id_kategori_beritas,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoriBeritas = KategoriBerita::all();
        return view('berita.edit', [
            'title' => 'Admin',
            'menu' => 'Berita',
            'berita' => $berita,
            'kategoriBeritas' => $kategoriBeritas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'berita' => 'required|string',
            'tgl_post' => 'required|date',
            'id_kategori_berita' => 'required|exists:kategori_beritas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('berita', 'public');
            $validated['foto'] = $path;
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}