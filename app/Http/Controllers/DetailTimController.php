<?php

namespace App\Http\Controllers;

use App\Models\DetailTim;
use App\Models\Aplikasi;
use App\Models\Pegawai;
use App\Models\JabatanKegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailTimController extends Controller
{
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $detailTim = DetailTim::with(['aplikasi', 'pegawai', 'jabatanKegiatan']) ->where('aplikasi_id', $id) 
            ->get();
            return DataTables::of($detailTim)
                ->addIndexColumn()
                ->addColumn('aplikasi', function ($row) {
                    return $row->aplikasi->namaAplikasi ?? '-';
                })
                ->addColumn('pegawai', function ($row) {
                    return $row->pegawai->nama ?? '-';
                })
                ->addColumn('jabatanKegiatan', function ($row) {
                    return $row->jabatanKegiatan->id ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="delete text-danger cursor-pointer" 
                        data-id="' . $row->id . '"
                        data-aplikasi_id="' . $row->aplikasi_id . '"
                        data-pegawai_id="' . $row->pegawai_id . '"
                        data-jabatan_kegiatan_id="' . $row->jabatan_kegiatan_id . '">
                        <i class="fas fa-trash-alt" title="Delete"></i>
                    </a>
                    <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer"
                            data-id="' . $row->id . '" 
                            data-aplikasi_id="' . $row->aplikasi_id . '"
                            data-pegawai_id="' . $row->pegawai_id . '"
                            data-jabatan_kegiatan_id="' . $row->jabatan_kegiatan_id . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action' ])
                ->make(true);
        }

        $aplikasi = Aplikasi::all();
        $pegawai = Pegawai::all();
        $jabatanKegiatan = JabatanKegiatan::all();
        dd($pegawai);
        dd($jabatanKegiatan);
        return view('manajemen-aplikasi.detailTim', [
            'currentPage' => 'Detail Tim',
            'aplikasi' => $aplikasi,
            'pegawai' => $pegawai,
            'jabatanKegiatan' => $jabatanKegiatan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'jabatan_kegiatan_id' => 'required|exists:jabatan_kegiatans,id',
        ]);

        DetailTim::create([
            'aplikasi_id' => $request->aplikasi_id,
            'pegawai_id' => $request->pegawai_id,
            'jabatan_kegiatan_id' => $request->jabatan_kegiatan_id,
        ]);
        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $detailTim = DetailTim::findOrFail($id);
        return response()->json($detailTim);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'jabatan_kegiatan_id' => 'required|exists:jabatan_kegiatans,id',
        ]);

        $detailTim = DetailTim::findOrFail($id);
        $detailTim->update([
            'aplikasi_id' => $request->aplikasi_id,
            'pegawai_id' => $request->pegawai_id,
            'jabatan_kegiatan_id' => $request->jabatan_kegiatan_id,
        ]);

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        DetailTim::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
