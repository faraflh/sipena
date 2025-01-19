<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\JabatanPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with(['golongan', 'jabatanPegawai'])->paginate(5); // Paginate 5 items per page
        $golongan = Golongan::all();
        $jabatanPegawai = JabatanPegawai::all();
        return view('pegawai', compact('pegawai', 'golongan', 'jabatanPegawai'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nip_nik' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'namaRek' => 'required|string|max:255',
            'noRek' => 'required|integer',
            'bank' => 'required|string|max:255',
            'golongan_id' => 'required|exists:golongans,id',
            'jabatan_pegawai_id' => 'required|exists:jabatan_pegawais,id',
            'email' => 'required|email|max:255',
        ]);

        Pegawai::create($request->all());
        return redirect()->route('pegawai.index')->with('success', 'Pegawai created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip_nik' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'namaRek' => 'required|string|max:255',
            'noRek' => 'required|integer',
            'bank' => 'required|string|max:255',
            'golongan_id' => 'required|exists:golongans,id',
            'jabatan_pegawai_id' => 'required|exists:jabatan_pegawais,id',
            'email' => 'required|email|max:255',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('error', 'Pegawai update failed.');
    }

    public function destroy($id)
    {
        Pegawai::destroy($id);
        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}
