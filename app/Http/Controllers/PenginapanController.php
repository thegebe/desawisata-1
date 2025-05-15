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
    // Validasi data
    $request->validate([
        'nama_penginapan' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'fasilitas' => 'required|string',
        'foto1' => 'nullable|image|max:5120',
        'foto2' => 'nullable|image|max:5120',
        'foto3' => 'nullable|image|max:5120',
        'foto4' => 'nullable|image|max:5120',
        'foto5' => 'nullable|image|max:5120',
    ]);

    // Simpan data ke database
    $penginapan = new Penginapan();
    $penginapan->nama_penginapan = $request->nama_penginapan;
    $penginapan->deskripsi = $request->deskripsi;
    $penginapan->fasilitas = $request->fasilitas;

    // Simpan foto jika ada
    for ($i = 1; $i <= 5; $i++) {
        $fotoField = 'foto' . $i;
        if ($request->hasFile($fotoField)) {
            $file = $request->file($fotoField);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penginapan'), $filename);
            $penginapan->{'foto' . $i} = $filename;
        }
    }

    $penginapan->save();

    // Redirect ke halaman index dengan pesan sukses
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
            'fasilitas' => 'nullable|string|max:255',
            'foto1' => 'nullable|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'foto4' => 'nullable|image|max:5120',
            'foto5' => 'nullable|image|max:5120',
        ]);

        foreach (['foto1', 'foto2', 'foto3', 'foto4', 'foto5'] as $foto) {
            if ($request->hasFile($foto)) {
                if ($penginapan->$foto) Storage::delete($penginapan->$foto);
                $data[$foto] = $request->file($foto)->store('penginapan');
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
        foreach (['foto1', 'foto2', 'foto3', 'foto4', 'foto5'] as $foto) {
            if ($penginapan->$foto) Storage::delete($penginapan->$foto);
        }

        $penginapan->delete();
        return redirect()->route('penginapan.index')->with('success', 'Penginapan berhasil dihapus!');
    }
}
