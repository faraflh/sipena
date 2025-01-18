<?php

namespace App\Http\Controllers;

use App\Models\JabatanPegawai;
use Illuminate\Http\Request;

class JabatanPegawaiController extends Controller
{
    public function index()
    {
        return response()->json(JabatanPegawai::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaJabatan' => 'required|string|max:30',
        ]);

        $jabatanPegawai = JabatanPegawai::create($request->all());
        return response()->json($jabatanPegawai, 201);
    }

    public function show($id)
    {
        $jabatanPegawai = JabatanPegawai::findOrFail($id);
        return response()->json($jabatanPegawai);
    }

    public function update(Request $request, $id)
    {
        $jabatanPegawai = JabatanPegawai::findOrFail($id);
        $jabatanPegawai->update($request->all());
        return response()->json($jabatanPegawai);
    }

    public function destroy($id)
    {
        JabatanPegawai::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
