<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        return view('manajemen-aplikasi.kegiatan', ['currentPage' => 'Kegiatan']);
    }

    public function getData()
    {
        return datatables()->of(\App\Models\Kegiatan::query())
            ->addColumn('actions', function ($kegiatan) {
                return '
                <button data-id="' . $kegiatan->id . '" class="btn btn-sm btn-primary edit">Edit</button>
                <button data-id="' . $kegiatan->id . '" class="btn btn-sm btn-danger delete">Delete</button>
            ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKegiatan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        \App\Models\Kegiatan::create($request->all());
        return response()->json(['success' => 'Kegiatan created successfully']);
    }

    public function update(Request $request, \App\Models\Kegiatan $kegiatan)
    {
        $request->validate([
            'namaKegiatan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $kegiatan->update($request->all());
        return response()->json(['success' => 'Kegiatan updated successfully']);
    }

    public function destroy(\App\Models\Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return response()->json(['success' => 'Kegiatan deleted successfully']);
    }





}
