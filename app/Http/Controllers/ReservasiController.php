<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah user sudah memiliki data pelanggan
        if (Auth::check() && !Auth::user()->pelanggan) {
        // Buat data pelanggan default jika belum ada
        Pelanggan::create([
            'id_user' => Auth::id(),
            'nama_lengkap' => Auth::user()->name,
            'no_hp' => '-', // Default value
            'alamat' => '-',
            'foto' => null,
        ]);
    }

    $pakets = PaketWisata::all();
    return view('fe.reservasi', compact('pakets'));
        // $pakets = PaketWisata::all();
        // return view('fe.reservasi', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pakets = PaketWisata::all();
        return view('fe.reservasi', compact('pakets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Jika belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
        // mastiian user sudah login
        if (Auth::check() && !Auth::user()->pelanggan) {
        Pelanggan::create([
            'id_user' => Auth::id(),
            'nama_lengkap' => $request->input('nama_lengkap'), // Ambil dari form
            'no_hp' => $request->input('no_hp'),
            'alamat' => '-', // Default atau ambil dari form
            'foto' => null,
        ]);
        }

        // Jika sudah login tetapi belum ada data pelanggan, buat data default
        if (!Auth::user()->pelanggan) {
        Pelanggan::create([
            'id_user' => Auth::id(),
            'nama_lengkap' => Auth::user()->name,
            'no_hp' => '-',
            'alamat' => '-',
        ]);

        $pakets = PaketWisata::all();
        return view('fe.reservasi', compact('pakets'));
    }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
