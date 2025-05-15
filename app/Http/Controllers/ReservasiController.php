<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasis = Reservasi::with(['pelanggan', 'paketWisata'])->get();
        return view('reservasi.index', compact('reservasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $paketWisatas = PaketWisata::all();
        return view('reservasi.create', compact('pelanggans', 'paketWisatas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi_wisata' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0',
            'file_bukti_tf' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();
        $paket = PaketWisata::findOrFail($request->id_paket);
        $data['harga'] = $paket->harga_per_pack;
        $data['nilai_diskon'] = $data['diskon'] ? ($data['harga'] * $data['jumlah_peserta'] * $data['diskon'] / 100) : 0;
        $data['total_bayar'] = ($data['harga'] * $data['jumlah_peserta']) - $data['nilai_diskon'];

        if ($request->hasFile('file_bukti_tf')) {
            $data['file_bukti_tf'] = $request->file('file_bukti_tf')->store('bukti_transfer', 'public');
        }

        Reservasi::create($data);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasi = Reservasi::with(['pelanggan', 'paketWisata'])->findOrFail($id);
        return view('reservasi.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $pelanggans = Pelanggan::all();
        $paketWisatas = PaketWisata::all();
        return view('reservasi.edit', compact('reservasi', 'pelanggans', 'paketWisatas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi_wisata' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0',
            'file_bukti_tf' => 'nullable|file|max:5120',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $data = $request->all();
        $paket = PaketWisata::findOrFail($request->id_paket);
        $data['harga'] = $paket->harga_per_pack;
        $data['nilai_diskon'] = $data['diskon'] ? ($data['harga'] * $data['jumlah_peserta'] * $data['diskon'] / 100) : 0;
        $data['total_bayar'] = ($data['harga'] * $data['jumlah_peserta']) - $data['nilai_diskon'];

        if ($request->hasFile('file_bukti_tf')) {
            $data['file_bukti_tf'] = $request->file('file_bukti_tf')->store('bukti_transfer', 'public');
        }

        $reservasi->update($data);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}
