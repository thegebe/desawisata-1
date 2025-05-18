<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObyekWisata;
use App\Models\PaketWisata;
use App\Models\Penginapan;
use App\Models\Berita;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $obyekWisatas = ObyekWisata::with('kategoriWisata')->latest()->get();
        // $paketWisatas = PaketWisata::latest()->get();
        // $penginapans  = Penginapan::latest()->get();
        // $beritas = Berita::latest()->take(6)->get(); // Ambil 6 berita terbaru

        // return view('fe.master', compact('obyekWisatas', 'paketWisatas', 'penginapans', 'beritas'));

        // Ambil data dari database
        $data = [
            'obyekWisatas' => ObyekWisata::with('kategoriWisata')->get(),
            'paketWisatas' => PaketWisata::latest()->get(),
            'penginapans' => Penginapan::latest()->get(),
            'beritas' => Berita::with('kategoriBerita')->latest()->limit(4)->get(),
        ];

        return view('fe.master', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
