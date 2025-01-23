<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('namaKategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->get();
        
        return view('kategori', [
            'kategori' => $kategori,
            'currentPage' => 'Kategori', 
        ]);    
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:20',
        ]);

        $kategori = Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('error', 'Kategori update failed.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:20',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('error', 'Kategori update failed.');
    }


    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect()->route('kategori.index')->with('success', 'Kategori deleted successfully.');
    }
}
