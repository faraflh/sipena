<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\JabatanPegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pegawai = Pegawai::with(['golongan', 'jabatanPegawai'])->get();
            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('golongan', function ($row) {
                    return $row->golongan->nama ?? '-';
                })
                ->addColumn('jabatan', function ($row) {
                    return $row->jabatanPegawai->nama ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt" title="Delete"></i>
                        </a>
                        <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer" data-id="' . $row->id . '"
                            data-nip_nik="' . $row->nip_nik . '"
                            data-nama="' . $row->nama . '"
                            data-namaRek="' . $row->namaRek . '"
                            data-noRek="' . $row->noRek . '"
                            data-bank="' . $row->bank . '"
                            data-email="' . $row->email . '"
                            data-golongan_id="' . $row->golongan_id . '"
                            data-jabatan_pegawai_id="' . $row->jabatan_pegawai_id . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                        </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $golongan = Golongan::all();
        $jabatanPegawai = JabatanPegawai::all();
        return view('pegawai', [
            'currentPage' => 'Pegawai',
            'golongan' => $golongan,
            'jabatanPegawai' => $jabatanPegawai,
        ]);
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
        return response()->json(['success' => 'Pegawai berhasil ditambahkan!']);
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return response()->json($pegawai);
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

        return response()->json(['success' => 'Pegawai berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        Pegawai::destroy($id);
        return response()->json(['success' => 'Pegawai berhasil dihapus!']);
    }
}
