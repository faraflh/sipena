<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        return response()->json(Dokumen::with(['kategori', 'alur'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            '' => 'required|exists:kategori,id',
            'idAlur' => 'required|exists:alur,id',
            'jenisDokumen' => 'required|string|max:100',
        ]);

        $dokumen = Dokumen::create($request->all());
        return response()->json($dokumen, 201);
    }

    public function show($id)
    {
        $dokumen = Dokumen::with(['kategori', 'alur'])->findOrFail($id);
        return response()->json($dokumen);
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update($request->all());
        return response()->json($dokumen);
    }

    public function destroy($id)
    {
        Dokumen::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
