<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas'; // Nama tabel di database
    protected $fillable = [
        'judul',
        'berita',
        'tgl_post',
        'id_kategori_beritas',
        'foto'
    ];

    /**
     * Relasi ke model KategoriBerita
     * Berita memiliki satu kategori (belongsTo)
     */
    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori_beritas');
    }
}