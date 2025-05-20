<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'alamat',
        'foto',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getClaimedVouchersAttribute()
    {
        return json_decode($this->voucher_claimed ?? '[]', true);
    }

    protected $casts = [
        'voucher_claimed' => 'json', // Menyimpan voucher_claimed sebagai JSON
    ];

    public function hasClaimedVoucher($voucherId)
    {
        $claimedVouchers = json_decode($this->voucher_claimed ?? '[]', true);
        return collect($claimedVouchers)->contains('diskon_id', $voucherId);
    }

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'id_pelanggan');
    }
}