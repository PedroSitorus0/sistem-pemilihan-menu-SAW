<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Menu;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SawController extends Controller
{
    public function index()
    {
        // Panggil fungsi perhitungan, ambil semua data mentah dan hasil
        $data = $this->hitungSaw();
        return view('saw.index', $data);
    }

   public function hasil()
    {
        // Ambil semua data dari fungsi perhitungan
        $data = $this->hitungSaw();
        
        $hasil = $data['hasil'];
        $kriteria = $data['kriteria']; // <-- Tambahkan baris ini untuk mengambil kriteria

        // Kirim 'hasil' dan 'kriteria' ke view
        return view('saw.hasil', compact('hasil', 'kriteria')); 
    }

    private function hitungSaw()
    {
        $kriteria = Kriteria::all();
        $menus = Menu::all();
        
        // 1. Ambil rata-rata penilaian
        $rataRata = Penilaian::select('menu_id', 'kriteria_id', DB::raw('AVG(nilai) as rata'))
            ->groupBy('menu_id', 'kriteria_id')
            ->get();

        // 2. Bentuk Matriks Keputusan (X)
        $matriks = [];
        foreach ($rataRata as $item) {
            $matriks[$item->menu_id][$item->kriteria_id] = $item->rata;
        }

        // Cari Nilai Max/Min per kriteria
        $maxMin = [];
        foreach ($kriteria as $k) {
            $nilaiKriteria = [];
            foreach ($menus as $m) {
                $nilaiKriteria[] = $matriks[$m->id][$k->id] ?? 0;
            }
            $maxMin[$k->id] = ($k->sifat === 'benefit') ? (max($nilaiKriteria) ?: 1) : (min($nilaiKriteria) ?: 1);
        }

        // 3. Matriks Normalisasi (R) & Perhitungan Skor Akhir (V)
        // 3. Matriks Normalisasi (R) & Perhitungan Skor Akhir (V)
        $normalisasi = [];
        $hasil = [];
        
        foreach ($menus as $menu) {
            $totalSkor = 0;
            $kriteria_scores = []; // <-- TAMBAHKAN INI

            foreach ($kriteria as $k) {
                $nilaiAsli = $matriks[$menu->id][$k->id] ?? 0;
                $kriteria_scores[$k->id] = $nilaiAsli; // <-- SIMPAN DATA ASLI UNTUK SORTING
                
                // Hitung Normalisasi
                $norm = ($k->sifat === 'benefit') 
                        ? ($nilaiAsli / $maxMin[$k->id]) 
                        : ($maxMin[$k->id] / ($nilaiAsli ?: 1));
                        
                $normalisasi[$menu->id][$k->id] = $norm;
                $totalSkor += $norm * $k->bobot;
            }
            $hasil[] = [
                'menu' => $menu, 
                'skor' => $totalSkor,
                'kriteria_scores' => $kriteria_scores // <-- LEMPAR KE ARRAY HASIL
            ];
        }

        // 4. Urutkan berdasarkan skor tertinggi ke terendah
        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
        
        // Beri Peringkat
        foreach ($hasil as $index => &$item) {
            $item['peringkat'] = $index + 1;
        }

        // Kembalikan semua variabel yang dibutuhkan View
        return [
            'kriteria' => $kriteria,
            'menus' => $menus,
            'matriks' => $matriks,
            'normalisasi' => $normalisasi,
            'hasil' => $hasil
        ];
    }
}