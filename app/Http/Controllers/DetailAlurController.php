<?php

namespace App\Http\Controllers;
use App\Models\DetailAlur;
use App\Models\Aplikasi;
use App\Models\Alur;
use Illuminate\Http\Request;

class DetailAlurController extends Controller
{
    public function index(Request $request)
    {
        $detailAlur = DetailAlur::with('aplikasi', 'alur')->select('detail_alurs.*');
        $aplikasi = Aplikasi::all();
        $alur = Alur::all();

        if ($request->ajax()) {
            return datatables()->of($detailAlur)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('detailAlur.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>
                            <form action="' . route('detailAlur.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>';
                })
                ->make(true);
        }

        return view('manajemen-aplikasi.detailAlur', [
            'detailAlur' => $detailAlur->get(),
            'aplikasi' => $aplikasi,
            'alur' => $alur,
            'currentPage' => 'Detail Alur', 
        ]);
    }

    public function create()
    {
        return view('detailAlur');
    }

    public function store(Request $request)
    {
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'alur_id' => 'required|exists:alurs,id',
            'keterangan_alur' => 'required|string|max:255',
        ]);

        DetailAlur::create($request->all());

        return redirect()->route('detailAlur.index')->with('success', 'Detail Alur created successfully.');
    }

    public function edit($id)
    {
        $detailAlur = DetailAlur::findOrFail($id);
        return view('detailAlur.edit', compact('detailAlur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aplikasi_id' => 'required|exists:aplikasis,id',
            'alur_id' => 'required|exists:alurs,id',
            'keterangan_alur' => 'required|string|max:255',
        ]);

        $detailAlur = DetailAlur::findOrFail($id);
        $detailAlur->update($request->all());

        return redirect()->route('detailAlur.index')->with('success', 'Detail Alur updated successfully.');
    }

    public function destroy($id)
    {
        DetailAlur::destroy($id);
        return redirect()->route('detailAlur.index')->with('success', 'Detail Alur deleted successfully.');
    }
}
