<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kategori;
use App\Models\JabatanStatus;
use App\Models\JabatanKegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JabatanKegiatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jabatanKegiatan = JabatanKegiatan::with(['pegawai', 'kategori', 'jabatanStatus'])->get();
            return DataTables::of($jabatanKegiatan)
                ->addIndexColumn()
                ->addColumn('pegawai', function ($row) {
                    return $row->pegawai->nama ?? '-';
                })
                ->addColumn('kategori', function ($row) {
                    return $row->kategori->namaKategori ?? '-';
                })
                ->addColumn('jabatan_status', function ($row) {
                    return $row->jabatanStatus->namaJabatanStatus ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt" title="Delete"></i>
                        </a>
                        <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer" data-id="' . $row->id . '"
                            data-pegawai_id="' . $row->pegawai_id . '"
                            data-kategori_id="' . $row->kategori_id . '"
                            data-jabatan_status_id="' . $row->jabatan_status_id . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                        </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pegawai = Pegawai::all();
        $kategori = Kategori::all();
        $jabatanStatus = JabatanStatus::all();
        return view('jabatanKegiatan', [
            'currentPage' => 'Jabatan Kegiatan',
            'pegawai' => $pegawai,
            'kategori' => $kategori,
            'jabatanStatus' => $jabatanStatus,
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
        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $jabatanKegiatan = JabatanKegiatan::findOrFail($id);
        return response()->json($jabatanKegiatan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'jabatan_status_id' => 'required|exists:jabatan_statuses,id',
        ]);

        $jabatanKegiatan = JabatanKegiatan::findOrFail($id);
        $jabatanKegiatan->update([
            'pegawai_id' => $request->pegawai_id,
            'kategori_id' => $request->kategori_id,
            'jabatan_status_id' => $request->jabatan_status_id,
        ]);

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        JabatanKegiatan::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}