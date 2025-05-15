<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;

    /**
     * Tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'paket_wisatas';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'fasilitas',
        'harga_per_pack',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
    ];
}