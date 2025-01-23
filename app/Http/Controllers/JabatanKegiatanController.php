<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kategori;
use App\Models\JabatanStatus;
use App\Models\JabatanKegiatan;
use Illuminate\Http\Request;

class JabatanKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = JabatanKegiatan::query();
        $jabatanKegiatan = JabatanKegiatan::paginate(5);
        $pegawai = Pegawai::all();
        $kategori = Kategori::all();
        $jabatanStatus = JabatanStatus::all();

        if ($request->has('search') && $request->search != '') {
            $query->where('namaJabatanKegiatan', 'like', '%' . $request->search . '%');
        }
        
        return view('jabatanKegiatan', [
            'jabatanKegiatan' => $jabatanKegiatan,
            'pegawai' => $pegawai,
            'kategori' => $kategori,
            'jabatanStatus' => $jabatanStatus,
            'currentPage' => 'Jabatan Kegiatan', 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'jabatan_status_id' => 'required|exists:jabatan_statuses,id',
        ]);

        JabatanKegiatan::create([
            'pegawai_id' => $request->pegawai_id,
            'kategori_id' => $request->kategori_id,
            'jabatan_status_id' => $request->jabatan_status_id,
        ]);
        return redirect()->route('jabatanKegiatan.index')->with('success', 'Jabatan Kegiatan created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'jabatan_status_id' => 'required|exists:jabatan_statuses,id',
        ]);

        $jabatanKegiatan = JabatanKegiatan::findOrFail($id);
        $jabatanKegiatan->update($request->all());
        return redirect()->route('jabatanKegiatan.index')->with('error', 'Jabatan Kegiatan update failed.');
    }

    public function destroy($id)
    {
        JabatanKegiatan::destroy($id);
        return redirect()->route('jabatanKegiatan.index')->with('success', 'Jabatan Kegiatan deleted successfully.');
    }
}
