<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('level', 'pelanggan')->get(); // Hanya user dengan level 'pelanggan'
        return view('pelanggan.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'id_user' => 'required|exists:users,id',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pelanggan', 'public');
        }

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:5120',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            if ($pelanggan->foto) {
                Storage::disk('public')->delete($pelanggan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pelanggan', 'public');
        }

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->foto) {
            Storage::disk('public')->delete($pelanggan->foto);
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
