<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use Illuminate\Http\Request;

class DpaController extends Controller
{
    public function index()
    {
        return response()->json(Dpa::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'noSPT' => 'required|integer',
            'noSPPD' => 'required|integer',
            'tujuan' => 'required|string|max:255',
            'noRek' => 'required|integer',
            'noDPA' => 'required|integer',
            'subKeg' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
        ]);

        $dpa = Dpa::create($request->all());
        return response()->json($dpa, 201);
    }

    public function show($id)
    {
        $dpa = Dpa::findOrFail($id);
        return response()->json($dpa);
    }

    public function update(Request $request, $id)
    {
        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());
        return response()->json($dpa);
    }

    public function destroy($id)
    {
        Dpa::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
