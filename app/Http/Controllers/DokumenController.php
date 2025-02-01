<?php

namespace App\Http\Controllers;

use App\Models\Alur;
use App\Models\Dokumen;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $dokumen = Dokumen::with('kategori', 'alur')->get();
            return DataTables::of($dokumen)
                ->addIndexColumn()

                ->addColumn('kategori', function ($row) {
                    return $row->kategori->namaKategori ?? '-'; 
                })
                ->addColumn('alur', function ($row) {
                    return $row->alur->namaAlur ?? '-';
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '
                <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                    <i class="fas fa-trash-alt" title="Delete"></i>
                </a>
                <a href="javascript:void(0)" class="edit  ms-4 text-dark cursor-pointer" data-id="' . $row->id . '" data-kategori_id="' . $row->kategori_id . '" data-alur_id="' . $row->alur_id . '" data-jenisDokumen="' . $row->jenisDokumen . '">
                    <i class="fas fa-pencil-alt" title="Edit"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $kategori = Kategori::all(); 
        $alur = Alur::all(); 

        return view('dokumen', data: [
            'kategori' => $kategori,
            'alur' => $alur,
            'currentPage' => 'Dokumen', 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'alur_id' => 'required|exists:alurs,id',
            'jenisDokumen' => 'required|string|max:100',        
        ]);
        
        Dokumen::create([
            'kategori_id' => $request->kategori_id,
            'alur_id' => $request->alur_id,
            'jenisDokumen' => $request->jenisDokumen,
        ]);
        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $dokumen = Dokumen::find($id);
        return response()->json($dokumen);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'alur_id' => 'required|exists:alurs,id',
            'jenisDokumen' => 'required|string|max:100',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update([
            'kategori_id' => $request->kategori_id,
            'alur_id' => $request->alur_id,
            'jenisDokumen' => $request->jenisDokumen,
        ]);

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        Dokumen::destroy($id);
        return response()->json(['success' => 'Data deleted successfully!']);
    }
}
