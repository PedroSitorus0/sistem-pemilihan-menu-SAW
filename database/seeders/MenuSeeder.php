<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_menu'    => 'Nasi Goreng Spesial',
                'kategori'     => 'Makanan Berat',
                'harga'        => 11000,
                'deskripsi'    => 'Nasi goreng dengan telur ceplok, disajikan dengan taburan bawang goreng.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Ayam Bakar',
                'kategori'     => 'Makanan Berat',
                'harga'        => 14000,
                'deskripsi'    => 'Ayam bakar bumbu kecap, disajikan dengan sambal dan lalapan.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Ayam Teriyaki',
                'kategori'     => 'Makanan Berat',
                'harga'        => 14000,
                'deskripsi'    => 'Ayam fillet saus teriyaki manis gurih.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Chicken Katsu',
                'kategori'     => 'Makanan Berat',
                'harga'        => 14000,
                'deskripsi'    => 'Ayam crispy dengan saus katsu khas.',
                'ketersediaan' => 'tanpa keterangan',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Pisang Coklat',
                'kategori'     => 'Snack',
                'harga'        => 5000,
                'deskripsi'    => 'Pisang goreng crispy isi coklat leleh.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Cheese Roll',
                'kategori'     => 'Snack',
                'harga'        => 5000,
                'deskripsi'    => 'Kulit lumpia crispy isi keju leleh.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Risoles',
                'kategori'     => 'Snack',
                'harga'        => 5000,
                'deskripsi'    => 'Risoles isi sayur dan ragout, digoreng crispy.',
                'ketersediaan' => 'tidak tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Lumine Coffee',
                'kategori'     => 'Minuman',
                'harga'        => 6000,
                'deskripsi'    => 'Kopi susu segar dengan campuran gula aren.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Mango Juice',
                'kategori'     => 'Minuman',
                'harga'        => 7000,
                'deskripsi'    => 'Jus mangga segar tanpa pengawet.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
            [
                'nama_menu'    => 'Lemon Tea',
                'kategori'     => 'Minuman',
                'harga'        => 6000,
                'deskripsi'    => 'Teh dingin segar dengan perasan lemon asli.',
                'ketersediaan' => 'tersedia',
                'foto'         => null,
            ],
        ];
 
        foreach ($data as $item) {
            Menu::create($item);
        }
    }
}
    

