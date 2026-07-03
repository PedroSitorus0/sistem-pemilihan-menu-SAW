<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Menu;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SawController extends Controller
{
    /**
     * Menampilkan proses dan hasil perhitungan SAW (untuk admin/dev).
     */
    public function index()
    {
        // 1. Ambil semua kriteria
        $kriteria = Kriteria::all();

        // 2. Ambil data rata‑rata penilaian per menu per kriteria
        $rataRata = Penilaian::select('menu_id', 'kriteria_id', DB::raw('AVG(nilai) as rata'))
            ->groupBy('menu_id', 'kriteria_id')
            ->get();

        // 3. Ambil semua menu
        $menus = Menu::all();

        // 4. Susun matriks alternatif (menu) vs kriteria
        $matriks = [];
        foreach ($menus as $menu) {
            foreach ($kriteria as $k) {
                // cari nilai rata-rata untuk pasangan ini
                $nilai = $rataRata->where('menu_id', $menu->id)
                                  ->where('kriteria_id', $k->id)
                                  ->first();
                $matriks[$menu->id][$k->id] = $nilai ? $nilai->rata : 0;
            }
        }

        // 5. Cari max/min untuk normalisasi
        $maxMin = [];
        foreach ($kriteria as $k) {
            $nilaiKriteria = array_column($matriks, $k->id);
            if ($k->sifat === 'benefit') {
                $maxMin[$k->id] = max($nilaiKriteria) ?: 1; // hindari pembagian 0
            } else { // cost
                $maxMin[$k->id] = min($nilaiKriteria) ?: 1;
            }
        }

        // 6. Hitung normalisasi & nilai akhir
        $hasil = [];
        foreach ($menus as $menu) {
            $total = 0;
            foreach ($kriteria as $k) {
                $nilaiAsli = $matriks[$menu->id][$k->id];
                if ($k->sifat === 'benefit') {
                    $normal = $nilaiAsli / $maxMin[$k->id];
                } else {
                    $normal = $maxMin[$k->id] / $nilaiAsli;
                }
                $total += $normal * $k->bobot;
            }
            $hasil[] = [
                'menu'   => $menu,
                'skor'   => $total,
            ];
        }

        // 7. Urutkan dari skor tertinggi
        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);

        // 8. Beri peringkat
        $peringkat = 1;
        foreach ($hasil as &$item) {
            $item['peringkat'] = $peringkat++;
        }

        return view('saw.index', compact('kriteria', 'matriks', 'menus', 'hasil'));
    }

    /**
     * Menampilkan hasil akhir untuk penilai (tanpa detail perhitungan).
     */
    public function hasil()
    {
        $hasil = $this->hitungSaw();
        return view('saw.hasil', compact('hasil'));
    }

    /**
     * Method pembantu untuk menghitung SAW (dapat digunakan ulang).
     */
    private function hitungSaw()
    {
        // Sama seperti index, tapi hanya kembalikan array hasil
        $kriteria = Kriteria::all();
        $rataRata = Penilaian::select('menu_id', 'kriteria_id', DB::raw('AVG(nilai) as rata'))
            ->groupBy('menu_id', 'kriteria_id')
            ->get();
        $menus = Menu::all();

        $matriks = [];
        foreach ($menus as $menu) {
            foreach ($kriteria as $k) {
                $nilai = $rataRata->where('menu_id', $menu->id)->where('kriteria_id', $k->id)->first();
                $matriks[$menu->id][$k->id] = $nilai ? $nilai->rata : 0;
            }
        }

        $maxMin = [];
        foreach ($kriteria as $k) {
            $nilaiKriteria = array_column($matriks, $k->id);
            $maxMin[$k->id] = $k->sifat === 'benefit' ? max($nilaiKriteria) : min($nilaiKriteria);
            if ($maxMin[$k->id] == 0) $maxMin[$k->id] = 1;
        }

        $hasil = [];
        foreach ($menus as $menu) {
            $total = 0;
            foreach ($kriteria as $k) {
                $nilaiAsli = $matriks[$menu->id][$k->id];
                $normal = $k->sifat === 'benefit' ? $nilaiAsli / $maxMin[$k->id] : $maxMin[$k->id] / $nilaiAsli;
                $total += $normal * $k->bobot;
            }
            $hasil[] = ['menu' => $menu, 'skor' => $total];
        }
        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
        $peringkat = 1;
        foreach ($hasil as &$item) {
            $item['peringkat'] = $peringkat++;
        }
        return $hasil;
    }
}