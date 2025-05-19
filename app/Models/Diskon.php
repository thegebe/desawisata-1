<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskon';

    protected $fillable = [
        'kode',
        'nama_promo',
        'deskripsi',
        'nilai',
        'tipe',
        'min_transaksi',
        'tanggal_mulai',
        'tanggal_berakhir',
        'kuota',
        'digunakan'
    ];

    protected $dates = ['tanggal_mulai', 'tanggal_berakhir'];
}
