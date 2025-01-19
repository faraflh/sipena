<?php

namespace App\Http\Controllers;

use App\Models\JabatanKegiatan;
use App\Models\Pegawai;
use App\Models\Kategori;
use App\Models\JabatanStatus;
use Illuminate\Http\Request;

class JabatanKegiatanController extends Controller
{
    public function index()
    {
        $jabatanKegiatan = JabatanKegiatan::with(['pegawai', 'kategori', 'jabatanStatus'])->get();
        $pegawai = Pegawai::all();
        $kategori = Kategori::all();
        $jabatanStatus = JabatanStatus::all();

        return view('jabatanKegiatan', compact('jabatanKegiatan', 'pegawai', 'kategori', 'jabatanStatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'jabStatus' => 'required|exists:jabatan_statuses,id',
        ]);

        JabatanKegiatan::create([
            'pegawai_id' => $request->idPegawai,
            'kategori_id' => $request->idKategori,
            'jabStatus' => $request->jabatanStatus,
        ]);
    
        return redirect()->route('jabatanKegiatan.index')->with('success', 'Jabatan Kegiatan created successfully.');
    }

    public function show($id)
    {
        $jabatanKegiatan = JabatanKegiatan::with(['pegawai', 'kategori'])->findOrFail($id);
        return response()->json($jabatanKegiatan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'jabStatus' => 'required|exists:jabatan_statuses,id',
        ]);

        $jabatanKegiatan = JabatanKegiatan::findOrFail($id);
        $jabatanKegiatan->update($request->all());
        return redirect()->route('jabatanKegiatan.index')->with('error', 'Pegawai update failed.');
    }

    public function destroy($id)
    {
        JabatanKegiatan::destroy($id);
        return redirect()->route('jabatanKegiatan.index')->with('success', 'Pegawai deleted successfully.');
    }
}
