<?php

namespace App\Http\Controllers;

use App\Models\JabatanKegiatan;
use Illuminate\Http\Request;

class JabatanKegiatanController extends Controller
{
    public function index()
    {
        return response()->json(JabatanKegiatan::with(['pegawai', 'kategori'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPegawai' => 'required|exists:pegawai,id',
            'idKategori' => 'required|exists:kategori,id',
            'jabStatus' => 'required|string|max:255',
        ]);

        $jabatanKegiatan = JabatanKegiatan::create($request->all());
        return response()->json($jabatanKegiatan, 201);
    }

    public function show($id)
    {
        $jabatanKegiatan = JabatanKegiatan::with(['pegawai', 'kategori'])->findOrFail($id);
        return response()->json($jabatanKegiatan);
    }

    public function update(Request $request, $id)
    {
        $jabatanKegiatan = JabatanKegiatan::findOrFail($id);
        $jabatanKegiatan->update($request->all());
        return response()->json($jabatanKegiatan);
    }

    public function destroy($id)
    {
        JabatanKegiatan::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
