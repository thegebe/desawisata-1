<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\PaketWisata;
use App\Models\Pelanggan;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Voucher;

class ReservasiController extends Controller
{
    /**
     * Menampilkan halaman reservasi frontend
     */
    public function index()
    {
        $pakets = PaketWisata::all();
        return view('fe.reservasi', compact('pakets'));
    }

    /**
     * Menampilkan form reservasi
     */
    public function create()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $pakets = PaketWisata::all();
        return view('reservasi.create', compact('pakets'));
    }

    /**
     * Menyimpan data reservasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi_wisata' => 'required|date|after_or_equal:today',
            'jumlah_peserta' => 'required|integer|min:1',
            'file_bukti_tf' => 'required|file|max:5120',
            'voucher_code' => 'nullable|string',
        ]);

        try {
            $paket = PaketWisata::findOrFail($request->id_paket);
            $harga = $paket->harga_per_pack;
            $subtotal = $harga * $request->jumlah_peserta;
            $nilai_diskon = 0;
            $diskon_id = null;

            if ($request->voucher_code) {
                $voucher = Voucher::where('kode', $request->voucher_code)->first();
                if ($voucher) {
                    $nilai_diskon = $subtotal * ($voucher->nilai_diskon / 100);
                    $diskon_id = $voucher->id;
                }
            }

            $total_bayar = $subtotal - $nilai_diskon;

            $filePath = $request->file('file_bukti_tf')->store('public/bukti_transfer');
            $filePath = str_replace('public/', '', $filePath);

            $reservasi = Reservasi::create([
                'id_pelanggan' => Auth::user()->pelanggan->id,
                'id_paket' => $request->id_paket,
                'tgl_reservasi_wisata' => $request->tgl_reservasi_wisata,
                'harga' => $harga,
                'jumlah_peserta' => $request->jumlah_peserta,
                'diskon' => $nilai_diskon > 0 ? 1 : 0,
                'nilai_diskon' => $nilai_diskon,
                'total_bayar' => $total_bayar,
                'file_bukti_tf' => $filePath,
                'status_reservasi_wisata' => 'pesan', // harus salah satu dari enum!
                'diskon_id' => $diskon_id,
            ]);

            return redirect()->route('reservasi.riwayat')
                ->with('success', 'Reservasi berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal membuat reservasi: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail reservasi
     */
    public function show($id)
    {
        $reservasi = Reservasi::with(['paketWisata', 'pelanggan'])
            ->findOrFail($id);

        // Pastikan hanya pemilik atau admin yang bisa melihat
        if (
            Auth::user()->role !== 'admin' &&
            Auth::user()->pelanggan->id !== $reservasi->id_pelanggan
        ) {
            abort(403, 'Unauthorized action.');
        }

        return view('reservasi.show', compact('reservasi'));
    }

    /**
     * Menampilkan riwayat reservasi user
     */
    public function riwayat()
    {
        $reservasis = Reservasi::with('paketWisata')
            ->where('id_pelanggan', Auth::user()->pelanggan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('fe.riwayatreservasi', compact('reservasis'));
    }

    /**
     * Menampilkan riwayat reservasi untuk satu reservasi spesifik
     */
    public function showRiwayat($id)
    {
        $reservasi = Reservasi::with(['paketWisata', 'pelanggan'])
            ->findOrFail($id);

        // Pastikan hanya pemilik atau admin yang bisa melihat
        if (
            Auth::user()->role !== 'admin' &&
            Auth::user()->pelanggan->id !== $reservasi->id_pelanggan
        ) {
            abort(403, 'Unauthorized action.');
        }

        return view('reservasi.show_riwayat', compact('reservasi'));
    }

    /**
     * Update status reservasi (untuk admin)
     */
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status_reservasi_wisata' => 'required|in:pesan,dibayar,selsesai',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi_wisata' => $request->status_reservasi_wisata]);

        return back()->with('success', 'Status reservasi berhasil diupdate');
    }
}
