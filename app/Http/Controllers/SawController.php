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
    // Cukup panggil method hitungSaw() agar kode lebih rapi
    $hasil = $this->hitungSaw();
    $kriteria = Kriteria::all();
    $menus = Menu::all();
    
    // Untuk index, kita mungkin butuh matriks juga jika ingin ditampilkan di view
    return view('saw.index', compact('kriteria', 'menus', 'hasil'));
    }

    /**
     * Menampilkan hasil akhir untuk penilai (tanpa detail perhitungan).
     */
    private function hitungSaw()
{
    $kriteria = Kriteria::all();
    $menus = Menu::all();
    
    // OPTIMASI: Ambil data sekaligus dan simpan dalam array asosiatif (cepat!)
    $rataRata = Penilaian::select('menu_id', 'kriteria_id', DB::raw('AVG(nilai) as rata'))
        ->groupBy('menu_id', 'kriteria_id')
        ->get();

    $matriks = [];
    foreach ($rataRata as $item) {
        $matriks[$item->menu_id][$item->kriteria_id] = $item->rata;
    }

    // Cari Max/Min
    $maxMin = [];
    foreach ($kriteria as $k) {
        $nilaiKriteria = [];
        foreach ($menus as $m) {
            $nilaiKriteria[] = $matriks[$m->id][$k->id] ?? 0;
        }
        
        $maxMin[$k->id] = ($k->sifat === 'benefit') ? (max($nilaiKriteria) ?: 1) : (min($nilaiKriteria) ?: 1);
    }

    // Hitung SAW
    $hasil = [];
    foreach ($menus as $menu) {
        $total = 0;
        foreach ($kriteria as $k) {
            $nilaiAsli = $matriks[$menu->id][$k->id] ?? 0;
            $normal = ($k->sifat === 'benefit') ? ($nilaiAsli / $maxMin[$k->id]) : ($maxMin[$k->id] / $nilaiAsli);
            $total += $normal * $k->bobot;
        }
        $hasil[] = ['menu' => $menu, 'skor' => $total];
    }

    usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
    
    foreach ($hasil as $i => &$item) {
        $item['peringkat'] = $i + 1;
    }
    
    return $hasil;
}
}