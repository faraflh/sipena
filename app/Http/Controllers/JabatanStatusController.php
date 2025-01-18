<?php

namespace App\Http\Controllers;

use App\Models\JabatanStatus;
use Illuminate\Http\Request;

class JabatanStatusController extends Controller
{
    public function index()
    {
        return response()->json(JabatanStatus::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaJabatanStatus' => 'required|string|max:30',
        ]);

        $jabatanStatus = JabatanStatus::create($request->all());
        return response()->json($jabatanStatus, 201);
    }

    public function show($id)
    {
        $jabatanStatus = JabatanStatus::findOrFail($id);
        return response()->json($jabatanStatus);
    }

    public function update(Request $request, $id)
    {
        $jabatanStatus = JabatanStatus::findOrFail($id);
        $jabatanStatus->update($request->all());
        return response()->json($jabatanStatus);
    }

    public function destroy($id)
    {
        JabatanStatus::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
