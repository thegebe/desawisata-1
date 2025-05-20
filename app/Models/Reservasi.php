<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'id_pelanggan',
        'id_paket',
        'tgl_reservasi_wisata',
        'harga',
        'jumlah_peserta',
        'nilai_diskon',
        'total_bayar',
        'file_bukti_tf',
        'status_reservasi_wisata',
        'diskon_id'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class, 'id_paket');
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }
}
