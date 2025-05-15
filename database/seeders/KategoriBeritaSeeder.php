<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriBeritaData = [
            ['kategori_berita' => 'Umum'],
            ['kategori_berita' => 'Kegiatan'],
            ['kategori_berita' => 'Pengumuman'],
        ];

        foreach ($kategoriBeritaData as $data) {
            KategoriBerita::create($data);
        }
    }
}