<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    protected $table = 'kategori_wisatas'; // Nama tabel di database
    protected $fillable = ['kategori_wisata']; // Kolom yang dapat diisi

    public function obyekWisatas()
    {
        return $this->hasMany(ObyekWisata::class, 'id_kategori_wisata'); // Relasi ke tabel obyek_wisatas
    }
}