<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Harga',
                'sifat' => 'cost',
                'bobot' => 0.30,
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Popularitas',
                'sifat'         => 'benefit',
                'bobot'         => 0.25,
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Ketersediaan',
                'sifat'         => 'cost',
                'bobot'         => 0.20,
            ],
            [
                 'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Tingkat Rasa',
                'sifat'         => 'benefit',
                'bobot'         => 0.25,
            ],
        ];
        foreach ($data as $item) {
            Kriteria::create($item);
        }
    }
}
