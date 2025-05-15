<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penginapans = Penginapan::all();
        return view('penginapan.index', compact('penginapans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penginapan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penginapan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'foto1' => 'required|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'foto4' => 'nullable|image|max:5120',
            'foto5' => 'nullable|image|max:5120',
        ]);

        $penginapan = new Penginapan();
        $penginapan->nama_penginapan = $request->nama_penginapan;
        $penginapan->deskripsi = $request->deskripsi;
        $penginapan->fasilitas = $request->fasilitas;

        for ($i = 1; $i <= 5; $i++) {
            $fotoField = 'foto' . $i;
            if ($request->hasFile($fotoField)) {
                $penginapan->{$fotoField} = $request->file($fotoField)->store('penginapan', 'public');
            } else {
                $penginapan->{$fotoField} = null; // <-- penting agar field tetap diisi
            }
        }

        $penginapan->save();

        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil ditambahkan.');
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
    public function edit(Penginapan $penginapan)
    {
        return view('penginapan.edit', compact('penginapan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penginapan $penginapan)
    {
        $data = $request->validate([
            'nama_penginapan' => 'required|string|max:255',
            'deskripsi' => 'required',
            'fasilitas' => 'required|string',
            'foto1' => 'nullable|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'foto4' => 'nullable|image|max:5120',
            'foto5' => 'nullable|image|max:5120',
        ]);

        // Update foto menggunakan Storage facade
        for ($i = 1; $i <= 5; $i++) {
            $fotoField = 'foto' . $i;
            if ($request->hasFile($fotoField)) {
                // Hapus foto lama jika ada
                if ($penginapan->{$fotoField}) {
                    Storage::disk('public')->delete($penginapan->{$fotoField});
                }
                // Simpan foto baru
                $path = $request->file($fotoField)->store('penginapan', 'public');
                $data[$fotoField] = $path;
            }
        }

        $penginapan->update($data);
        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penginapan $penginapan)
    {
        // Hapus semua foto terkait
        for ($i = 1; $i <= 5; $i++) {
            $fotoField = 'foto' . $i;
            if ($penginapan->{$fotoField}) {
                Storage::disk('public')->delete($penginapan->{$fotoField});
            }
        }

        $penginapan->delete();
        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil dihapus!');
    }
}
