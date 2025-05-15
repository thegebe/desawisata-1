<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketWisataController extends Controller
{
    public function index()
    {
        $paketWisatas = PaketWisata::latest()->get();
        return view('paketwisata.index', compact('paketWisatas'));
    }

    public function create()
    {
        return view('paketwisata.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string|max:255',
            'harga_per_pack' => 'required|integer|min:0',
            'foto1' => 'nullable|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'foto4' => 'nullable|image|max:5120',
            'foto5' => 'nullable|image|max:5120',
        ]);

        $data = $validated;

        // Handle file uploads
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'foto' . $i;
            if ($request->hasFile($fieldName)) {
                $data[$fieldName] = $request->file($fieldName)->store('paket_wisata', 'public');
            }
        }

        PaketWisata::create($data);

        return redirect()->route('paketwisata.index')->with('success', 'Paket wisata berhasil ditambahkan!');
    }

    public function edit(PaketWisata $paketWisata)
    {
        return view('paketwisata.edit', compact('paketWisata'));
    }

    public function update(Request $request, PaketWisata $paketWisata)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string|max:255',
            'harga_per_pack' => 'required|integer|min:0',
            'foto1' => 'nullable|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'foto4' => 'nullable|image|max:5120',
            'foto5' => 'nullable|image|max:5120',
        ]);

        $data = $validated;

        // Handle file uploads
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'foto' . $i;
            if ($request->hasFile($fieldName)) {
                // Delete old file if exists
                if ($paketWisata->$fieldName) {
                    Storage::disk('public')->delete($paketWisata->$fieldName);
                }
                $data[$fieldName] = $request->file($fieldName)->store('paket_wisata', 'public');
            }
        }

        $paketWisata->update($data);

        return redirect()->route('paketwisata.index')->with('success', 'Paket wisata berhasil diperbarui!');
    }

    public function destroy(PaketWisata $paketWisata)
    {
        try {
            // Hapus file terkait jika ada
            for ($i = 1; $i <= 5; $i++) {
                $fieldName = 'foto' . $i;
                if (!empty($paketWisata->$fieldName)) {
                    Storage::disk('public')->delete($paketWisata->$fieldName);
                }
            }

            // Hapus data dari database
            $paketWisata->delete();

            return redirect()->route('paketwisata.index')->with('success', 'Paket wisata berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('paketwisata.index')->with('error', 'Gagal menghapus paket wisata: ' . $e->getMessage());
        }
    }
}