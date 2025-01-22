<?php

namespace App\Http\Controllers;

use App\Models\Alur;
use App\Models\Dokumen;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::paginate(5);
        $kategori = Kategori::all(); // Panggil model Kategori
        $alur = Alur::all(); // Panggil model Alur
        return view('dokumen', [
            'dokumen' => $dokumen,
            'kategori' => $kategori,
            'alur' => $alur,
            'currentPage' => 'Dokumen', 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'alur_id' => 'required|exists:alurs,id',
            'jenisDokumen' => 'required|string|max:100',
        ]);

        Dokumen::create($request->all());
        return redirect()->route('dokumen.index')->with('error', 'Dokumen update failed.');
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'alur_id' => 'required|exists:alurs,id',
            'jenisDokumen' => 'required|string|max:100',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update($request->all());
        return redirect()->route('dokumen.index')->with('error', 'Dokumen update failed.');
    }

    public function destroy($id)
    {
        Dokumen::destroy($id);
        return redirect()->route('Dokumen.index')->with('success', 'Dokumen deleted successfully.');    }
}
