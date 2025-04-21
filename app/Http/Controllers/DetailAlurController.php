<?php

namespace App\Http\Controllers;

use App\Models\DetailAlur;
use App\Models\Aplikasi;
use App\Models\Alur;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailAlurController extends Controller
{
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $detailAlur = DetailAlur::with(['aplikasi', 'alur']) ->where('aplikasi_id', $id) 
            ->get();
            return DataTables::of($detailAlur)
                ->addIndexColumn()
                ->addColumn('aplikasi', function ($row) {
                    return $row->aplikasi->namaAplikasi ?? '-';
                })
                ->addColumn('alur', function ($row) {
                    return $row->alur->namaAlur ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="delete text-danger cursor-pointer" 
                        data-id="' . $row->id . '"
                        data-aplikasi_id="' . $row->aplikasi_id . '"
                        data-alur_id="' . $row->alur_id . '"
                        data-keterangan_alur="' . $row->keterangan_alur . '">
                        <i class="fas fa-trash-alt" title="Delete"></i>
                    </a>
                    <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer"
                            data-id="' . $row->id . '" 
                            data-aplikasi_id="' . $row->aplikasi_id . '"
                            data-alur_id="' . $row->alur_id . '"
                            data-keterangan_alur="' . $row->keterangan_alur . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action' ])
                ->make(true);
        }

        $aplikasi = Aplikasi::all();
        $alur = Alur::all();
        dd($alur);
        return view('manajemen-aplikasi.detailAlur', [
            'currentPage' => 'Detail Alur',
            'aplikasi' => $aplikasi,
            'alur' => $alur
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'alur_id' => 'required|exists:alurs,id',
            'keterangan_alur' => 'required|string',
        ]);

        DetailAlur::create([
            'aplikasi_id' => $request->aplikasi_id,
            'alur_id' => $request->alur_id,
            'keterangan_alur' => $request->keterangan_alur,
        ]);
        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $detailAlur = DetailAlur::findOrFail($id);
        return response()->json($detailAlur);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'alur_id' => 'required|exists:alurs,id',
            'keterangan_alur' => 'required|string',
        ]);

        $detailAlur = DetailAlur::findOrFail($id);
        $detailAlur->update([
            'aplikasi_id' => $request->aplikasi_id,
            'alur_id' => $request->alur_id,
            'keterangan_alur' => $request->keterangan_alur,
        ]);

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        DetailAlur::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}