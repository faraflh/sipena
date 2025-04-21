<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $kategori = Kategori::all();
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                    <i class="fas fa-trash-alt" title="Delete"></i>
                </a>
                <a href="javascript:void(0)" class="edit  ms-4 text-dark cursor-pointer" data-id="' . $row->id . '" data-namaKategori="' . $row->namaKategori . '">
                    <i class="fas fa-pencil-alt" title="Edit"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
            return view('kategori', [
            'currentPage' => 'Kategori', 
        ]);    
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:20',
        ]);

        Kategori::create([
            'namaKategori' => $request->namaKategori,
        ]);

        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:20',
        ]);

        $kategori = Kategori::find($id);
        $kategori->update([
            'namaKategori' => $request->namaKategori,
        ]);
        return response()->json(['success' => 'Data berhasil diubah!']);
    }


    public function destroy($id)
    {
        Kategori::destroy($id);
        return response()->json(['success' => 'Data deleted successfully!']);
    }
}
