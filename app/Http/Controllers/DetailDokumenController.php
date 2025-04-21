<?php

namespace App\Http\Controllers;

use App\Models\DetailDokumen;
<<<<<<< HEAD
use App\Models\Aplikasi;
=======
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailDokumenController extends Controller
{
<<<<<<< HEAD
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $detailDokumen = DetailDokumen::with(['aplikasi', 'dokumen']) ->where('aplikasi_id', $id) 
            ->get();
            return DataTables::of($detailDokumen)
                ->addIndexColumn()
                ->addColumn('aplikasi', function ($row) {
                    return $row->aplikasi->namaAplikasi ?? '-';
                })
                ->addColumn('dokumen', function ($row) {
                    return $row->dokumen->jenisDokumen ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="delete text-danger cursor-pointer" 
                        data-id="' . $row->id . '"
                        <i class="fas fa-trash-alt" title="Delete"></i>
                    </a>
                    <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer"
                            data-id="' . $row->id . '" 
                            data-aplikasi_id="' . $row->aplikasi_id . '"
                            data-namaDokumen="' . $row->namaDokumen . '"
                            data-file="' . $row->file . '"
                            data-dokumen_id="' . $row->dokumen_id . '"
                            data-noSurat="' . $row->noSurat . '"
                            data-perihal="' . $row->perihal . '"
                            data-tanggalSurat="' . $row->tanggalSurat . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action' ])
                ->make(true);
        }

        $aplikasi = Aplikasi::all();
        $dokumen = Dokumen::all();
        dd($dokumen);
        return view('manajemen-aplikasi.detailDokumen', [
            'currentPage' => 'Detail Dokumen',
            'aplikasi' => $aplikasi,
            'dokumen' => $dokumen,
        ]);
=======
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
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'namaDokumen' => 'required|string',
            'file' => 'required|string',
            'dokumen_id' => 'required|exists:dokumens,id',
            'noSurat' => 'required|string',
            'perihal' => 'required|string',
            'tanggalSurat' => 'required|date',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen', $fileName, 'public'); 
    
            DetailDokumen::create([
                'aplikasi_id' => $request->aplikasi_id,
                'namaDokumen' => $request->namaDokumen,
                'dokumen_id' => $request->dokumen_id,
                'noSurat' => $request->noSurat,
                'perihal' => $request->perihal,
                'tanggalSurat' => $request->tanggalSurat,
                'file' => $filePath,
            ]);    

            return response()->json(['success' => 'Data berhasil ditambah!']);
        }

        return response()->json(['error' => 'Gagal mengunggah file.'], 400);
        dd($request->all());
    }

    public function edit($id)
    {
        $detailDokumen = DetailDokumen::findOrFail($id);
        return response()->json($detailDokumen);
=======
        DetailDokumen::create($request->all());
        return response()->json(['success' => 'Data berhasil ditambahkan!']);
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'namaDokumen' => 'required|string',
            'file' => 'required|string',
            'dokumen_id' => 'required|exists:dokumens,id',
            'noSurat' => 'required|string',
            'perihal' => 'required|string',
            'tanggalSurat' => 'required|date',
        ]);

        $detailDokumen = DetailDokumen::findOrFail($id);
        $detailDokumen->update($request->all());

        return response()->json(['success' => 'Data berhasil diubah!']);
=======
        DetailDokumen::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Data berhasil diupdate!']);
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
    }

    public function destroy($id)
    {
        DetailDokumen::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
