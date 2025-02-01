<?php

namespace App\Http\Controllers;

use App\Models\DetailDokumen;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailDokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::all();
        return view('manajemen-aplikasi.detailDokumen', compact('dokumen'));
    }

    public function data()
    {
        $detailDokumen = DetailDokumen::with('dokumen')->get();
        return DataTables::of($detailDokumen)
            ->addIndexColumn()
            ->addColumn('dokumen', fn($row) => $row->dokumen->namaDokumen ?? '-')
            ->addColumn('action', function($row) {
                return '<button class="edit btn btn-warning" data-id="'.$row->id.'" data-dokumen_id="'.$row->dokumen_id.'" data-deskripsi="'.$row->deskripsi.'">Edit</button>
                        <button class="delete btn btn-danger" data-id="'.$row->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        DetailDokumen::create($request->all());
        return response()->json(['success' => 'Data berhasil ditambahkan!']);
    }

    public function update(Request $request, $id)
    {
        DetailDokumen::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Data berhasil diupdate!']);
    }

    public function destroy($id)
    {
        DetailDokumen::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
