<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DpaController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $dpa = Dpa::all();
            return DataTables::of($dpa)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                    <i class="fas fa-trash-alt" title="Delete"></i>
                </a>
                <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer" data-id="' . $row->id . '"
                    data-noSPT="' . $row->noSPT . '" 
                    data-noSPPD="' . $row->noSPPD . '" 
                    data-tujuan="' . $row->tujuan . '" 
                    data-noRek="' . $row->noRek . '" 
                    data-noDPA="' . $row->noDPA . '" 
                    data-subKeg="' . $row->subKeg . '" 
                    data-tahun="' . $row->tahun . '">
                    <i class="fas fa-pencil-alt" title="Edit"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dpa', [
            'currentPage' => 'DPA',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'noSPT' => 'required|integer',
            'noSPPD' => 'required|integer',
            'tujuan' => 'required|string|max:255',
            'noRek' => 'required|string|max:255',
            'noDPA' => 'required|string|max:255',
            'subKeg' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
        ]);

        Dpa::create($request->all());

        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $dpa = Dpa::findOrFail($id);
        return response()->json($dpa);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'noSPT' => 'required|integer',
            'noSPPD' => 'required|integer',
            'tujuan' => 'required|string|max:255',
            'noRek' => 'required|string|max:255',
            'noDPA' => 'required|string|max:255',
            'subKeg' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
        ]);

        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        Dpa::destroy($id);
        return response()->json(['success' => 'Data deleted successfully!']);
    }
}