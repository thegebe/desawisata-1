<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'level' => 'admin',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'level' => 'owner',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Bendahara',
                'email' => 'bendahara@gmail.com',
                'level' => 'bendahara',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Pelanggan',
                'email' => 'pelanggan@gmail.com',
                'level' => 'pelanggan',
                'password' => bcrypt('12345')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::firstOrCreate($val);
        }
    }
}
