<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapans';
    
    protected $fillable = [
        'nama_penginapan',
        'deskripsi',
        'fasilitas',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5'
    ];

    public function getFoto1Attribute($value)
    {
        return $value ? asset('storage/' . str_replace('public/', '', $value)) : null;
    }

    public function getFoto2Attribute($value)
    {
        return $value ? asset('storage/' . str_replace('public/', '', $value)) : null;
    }

    public function getFoto3Attribute($value)
    {
        return $value ? asset('storage/' . str_replace('public/', '', $value)) : null;
    }

    public function getFoto4Attribute($value)
    {
        return $value ? asset('storage/' . str_replace('public/', '', $value)) : null;
    }

    public function getFoto5Attribute($value)
    {
        return $value ? asset('storage/' . str_replace('public/', '', $value)) : null;
    }
}