<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\PaketWisata;
use App\Models\Pelanggan;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if (!auth()->check()) {
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
        // Validasi input
        $validated = $request->validate([
            'id_paket' => 'required|exists:paket_wisatas,id',
            'tgl_reservasi_wisata' => 'required|date|after_or_equal:today',
            'jumlah_peserta' => 'required|integer|min:1',
            'voucher_code' => 'nullable|exists:vouchers,kode', // Ubah validasi voucher
            'file_bukti_tf' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        try {
            // Hitung total bayar
            $paket = PaketWisata::findOrFail($request->id_paket);
            $harga = $paket->harga_per_pack;
            $subtotal = $harga * $request->jumlah_peserta;

            // Hitung diskon jika ada voucher
            $nilai_diskon = 0;
            if ($request->voucher_code) {
                $voucher = Voucher::where('kode', $request->voucher_code)->first();
                if ($voucher) {
                    $nilai_diskon = $subtotal * ($voucher->nilai_diskon / 100);
                }
            }

            $total_bayar = $subtotal - $nilai_diskon;

            // Simpan file bukti transfer
            $filePath = $request->file('file_bukti_tf')->store('bukti_transfer');

            // Buat reservasi baru
            $reservasi = Reservasi::create([
                'id_pelanggan' => auth()->user()->pelanggan->id,
                'id_paket' => $request->id_paket,
                'tgl_reservasi_wisata' => $request->tgl_reservasi_wisata,
                'harga' => $harga,
                'jumlah_peserta' => $request->jumlah_peserta,
                'diskon' => $request->diskon,
                'nilai_diskon' => $nilai_diskon,
                'total_bayar' => $total_bayar,
                'file_bukti_tf' => $filePath,
                'status_reservasi_wisata' => 'menunggu_verifikasi',
            ]);

            return redirect()->route('reservasi.show', $reservasi->id)
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
            auth()->user()->role !== 'admin' &&
            auth()->user()->pelanggan->id !== $reservasi->id_pelanggan
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
            ->where('id_pelanggan', auth()->user()->pelanggan->id)
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
            auth()->user()->role !== 'admin' &&
            auth()->user()->pelanggan->id !== $reservasi->id_pelanggan
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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status_reservasi_wisata' => 'required|in:menunggu_verifikasi,dikonfirmasi,dibatalkan'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi_wisata' => $request->status_reservasi_wisata]);

        return back()->with('success', 'Status reservasi berhasil diupdate');
    }
}
