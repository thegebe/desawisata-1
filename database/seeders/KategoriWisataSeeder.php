<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriWisata;

class KategoriWisataSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriWisataData = [
            ['kategori_wisata' => 'Alam'],
            ['kategori_wisata' => 'Budaya'],
            ['kategori_wisata' => 'Edukasi'],
        ];

        foreach ($kategoriWisataData as $data) {
            KategoriWisata::firstOrCreate($data);
        }
    }
}