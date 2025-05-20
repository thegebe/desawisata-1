<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'diskons'; // mapping ke tabel diskons

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
        'digunakan',
    ];

    // Relasi ke reservasi jika diperlukan
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'diskon_id');
    }
}
