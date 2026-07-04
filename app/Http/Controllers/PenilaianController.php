<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        // Gunakan pagination, misalnya 8 menu per halaman
        $menus = Menu::paginate(8); 
        
        // Kriteria tetap diambil semua
        $kriteria = Kriteria::all();
        
        // Ambil penilaian untuk mengecek apakah user sudah menilai atau belum (opsional untuk indikator di UI)
        $penilaian = Penilaian::where('user_id', auth()->id())->get();

        return view('penilaian.index', compact('menus', 'kriteria', 'penilaian'));
    }

    // Jangan lupa pastikan ada "use App\Models\Menu;" di bagian atas file

    public function show($id)
    {
        // 1. Ambil data menu secara eksplisit untuk mencegah error data kosong
        $menu = Menu::findOrFail($id);
        $kriteria = Kriteria::all();
        
        // 2. Ambil penilaian user yang SEDANG LOGIN untuk menu ini (agar bintang tersimpan)
        $penilaian = Penilaian::where('menu_id', $menu->id)
                              ->where('user_id', auth()->id())
                              ->get()
                              ->keyBy('kriteria_id');

        // 3. LOGIKA STATISTIK GLOBAL (Untuk UI Progress Bar)
        $allRatings = Penilaian::where('menu_id', $menu->id)->get();
        // Menghitung jumlah orang yang sudah menilai (mengelompokkan berdasarkan user_id)
        $totalVoters = $allRatings->groupBy('user_id')->count(); 
        $averageRating = $allRatings->avg('nilai') ?? 0;

        $ratingCounts = [
            5 => $allRatings->where('nilai', 5)->count(),
            4 => $allRatings->where('nilai', 4)->count(),
            3 => $allRatings->where('nilai', 3)->count(),
            2 => $allRatings->where('nilai', 2)->count(),
            1 => $allRatings->where('nilai', 1)->count(),
        ];
        
        $totalRatingsCount = $allRatings->count() ?: 1; // hindari pembagian 0
        $ratingPercentages = [];
        foreach($ratingCounts as $star => $count) {
            $ratingPercentages[$star] = round(($count / $totalRatingsCount) * 100);
        }

        return view('penilaian.show', compact('menu', 'kriteria', 'penilaian', 'totalVoters', 'averageRating', 'ratingPercentages'));
    }

    // public function store(Request $request, $id)
    // {
    //     $menu = Menu::findOrFail($id);
    //     $request->validate(['data' => 'required|array']);

    //     foreach ($request->data as $kriteriaId => $nilai) {
    //         Penilaian::updateOrCreate(
    //             ['menu_id' => $menu->id, 'kriteria_id' => $kriteriaId, 'user_id' => auth()->id()],
    //             ['nilai' => $nilai]
    //         );
    //     }

    //     return redirect()->route('penilaian.index')->with('success', 'Penilaian untuk ' . $menu->nama_menu . ' berhasil disimpan!');
    // }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'data'    => 'required|array'
        ]);

        // Cari menu berdasarkan input hidden
        $menu = Menu::findOrFail($request->menu_id);

        // Lakukan looping untuk menyimpan nilai
        foreach ($request->data as $kriteriaId => $nilai) {
            Penilaian::updateOrCreate(
                ['menu_id' => $menu->id, 'kriteria_id' => $kriteriaId, 'user_id' => auth()->id()],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian untuk ' . $menu->nama_menu . ' berhasil disimpan!');
    }
}