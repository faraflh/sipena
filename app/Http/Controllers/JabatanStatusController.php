<?php

namespace App\Http\Controllers;

use App\Models\JabatanStatus;
use Illuminate\Http\Request;

class JabatanStatusController extends Controller
{
    public function index()
    {
        $jabatanStatus = JabatanStatus::all();

        return view('jabatanStatus', compact('jabatanStatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaJabatanStatus' => 'required|string|max:30',
        ]);

        JabatanStatus::create($request->all());
        return redirect()->route('jabatanStatus.index')->with('success', 'Jabatan Status created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaJabatanStatus' => 'required|string|max:30',
        ]);

        $jabatanStatus = JabatanStatus::findOrFail($id);
        $jabatanStatus->update($request->all());
        return redirect()->route('jabatanStatus.index')->with('success', 'Jabatan Status updated successfully.');
    }

    public function destroy($id)
    {
        JabatanStatus::destroy($id);
        return redirect()->route('jabatanStatus.index')->with('success', 'Jabatan Status deleted successfully.');
    }
}
