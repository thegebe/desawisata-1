<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskons';
    protected $fillable = [
        'nama_promo',
        'kode',
        'detail_promo',
        'tanggal_mulai',
        'tanggal_berakhir',
        'minimal_transaksi',
        'jenis_diskon',
        'nilai_diskon',
        'maksimal_diskon',
        'kuota',
        'digunakan'
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function isValid()
    {
        return $this->tanggal_berakhir >= now() && $this->digunakan < $this->kuota;
    }
}