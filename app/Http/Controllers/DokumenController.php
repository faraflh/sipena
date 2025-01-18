<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\AlurController;
use App\Http\Controllers\KategoriController;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::all();
        $kategori = \App\Models\Kategori::all(); // Panggil model Kategori
        $alur = \App\Models\Alur::all(); // Panggil model Alur
        return view('dokumen', compact('dokumen', 'kategori', 'alur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idKategori' => 'required|exists:kategoris,id',
            'idAlur' => 'required|exists:alurs,id',
            'jenisDokumen' => 'required|string|max:100',
        ]);

        $dokumen = Dokumen::create($request->all());
        return redirect()->route('dokumen.index')->with('error', 'Dokumen update failed.');
    }

    // public function show($id)
    // {
    //     $dokumen = Dokumen::with(['kategori', 'alur'])->findOrFail($id);
    //     return redirect()->route('dokumen.index')->with('error', 'Dokumen update failed.');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idKategori' => 'required|exists:kategoris,id',
            'idAlur' => 'required|exists:alurs,id',
            'jenisDokumen' => 'required|string|max:100',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update($request->all());
        return redirect()->route('dokumen.index')->with('error', 'Dokumen update failed.');
    }

    public function destroy($id)
    {
        Dokumen::destroy($id);
        return redirect()->route('Dokumen.index')->with('success', 'Dokumen deleted successfully.');
    }
}
