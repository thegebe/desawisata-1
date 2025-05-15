<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_beritas'; // Nama tabel di database
    protected $fillable = ['kategori_berita']; // Kolom yang dapat diisi

    /**
     * Relasi ke model Berita
     * Kategori memiliki banyak berita (hasMany)
     */
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori_beritas');
    }
}