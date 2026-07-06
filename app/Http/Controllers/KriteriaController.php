<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::orderby('kode_kriteria')->get();
        $totalBobot = $kriteria->sum('bobot');
        return view('kriteria.index', compact('kriteria', 'totalBobot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|string|max:2|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required|string|max:20',
            'sifat' => 'required|in:cost,benefit',
            'bobot' => 'required|numeric|min:0|max:1', //bobot dalam desimal;
        ]);

        $totalBobot = Kriteria::sum('bobot') + $validated['bobot'];

        if ($totalBobot > 1) {
            return back()->withInput()->with('error', 'Total bobot melebihi 1. Bobot saat ini: ' .Kriteria::sum('bobot'));
        }

        Kriteria::create($validated);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriterium)
    {
        return view('kriteria.edit', compact('kriterium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|string|max:2|unique:kriteria,kode_kriteria,' .$kriterium->id,
            'nama_kriteria' => 'required|string|max:20',
            'sifat' => 'required|in:cost,benefit',
            'bobot' => 'required|numeric|min:0|max:1',
        ]);
        $totalBobotLainnya = Kriteria::where('id', '!=', $kriterium->id)->sum('bobot');
        if ($totalBobotLainnya + $validated['bobot'] > 1) {
            return back()->withInput()->with('error', "Total Bobot melebihi 1 setelah diperbaharui");
        }        


        $kriterium->update($validated);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria Berhasil Dihapus');
    }
}
