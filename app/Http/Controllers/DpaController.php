<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use Illuminate\Http\Request;

class DpaController extends Controller
{
    public function index(Request $request)
    {
        $query = dpa::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('namaDpa', 'like', '%' . $request->search . '%');
        }

        $dpa = Dpa::all();
        return view('dpa', [
            'dpa' => $dpa,
            'currentPage' => 'DPA', 
        ]);    
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
        return redirect()->route('dpa.index')->with('error', 'DPA update failed.');
    }

    public function update(Request $request, $id)
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

        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());
        return redirect()->route('dpa.index')->with('error', 'DPA update failed.');
    }

    public function destroy($id)
    {
        Dpa::destroy($id);
        return redirect()->route('dpa.index')->with('success', 'DPA deleted successfully.');
    }
}
