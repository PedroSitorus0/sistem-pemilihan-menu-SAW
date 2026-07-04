<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::latest()->paginate(10);
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:50',
            'kategori' => 'required|string|max:50',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'ketersediaan' => 'required|in:tersedia, tanpa keterangan, tidak tersedia',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('menus', 'public');
        }

        Menu::create($validated);
        return redirect()->route('menus.index')->with('success', 'Menu Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:50',
            'kategori' => 'required|string|max:50',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'ketersediaan' => 'required|in:tersedia, tanpa keterangan, tidak tersedia',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            $validated['foto'] = $request->file('foto')->store('menus', 'public');
        }
        $menu->update($validated);

        return redirect()->route('menus.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Data Berhasil Dihapus');
    }
}
