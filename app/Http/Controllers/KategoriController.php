<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:20',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori created successfully.');
    }

    // public function show($id)
    // {
    //     $kategori = Kategori::findOrFail($id);
    //     return response()->json($kategori);
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:20',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori updated successfully.');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect()->route('kategori.index')->with('success', 'Kategori deleted successfully.');
    }
}
