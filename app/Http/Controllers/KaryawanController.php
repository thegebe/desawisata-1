<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::with('user')->paginate(10);
        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Ambil semua user
        $jabatan = ['administrasi', 'bendahara', 'pemilik']; // Hardcode nilai ENUM
        return view('karyawan.create', compact('users', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'jabatan' => 'required|in:administrasi,bendahara,pemilik', // Validasi ENUM
            'id_user' => 'required|exists:users,id',
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
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
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $users = User::all(); // Ambil semua user
        $jabatan = ['administrasi', 'bendahara', 'pemilik']; // Hardcode nilai ENUM
        return view('karyawan.edit', compact('karyawan', 'users', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama_karyawan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'jabatan' => 'required|in:administrasi,bendahara,pemilik', // Validasi ENUM
            'id_user' => 'required|exists:users,id',
        ]);

        $karyawan->update($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}