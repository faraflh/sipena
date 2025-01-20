<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        return view('golongan', [
            'golongan' => $golongan,
            'currentPage' => 'Golongan', 
        ]);    }

    public function store(Request $request)
    {
        $request->validate([
            'namaGolPang' => 'required|string|max:10',
        ]);

        $golongan = Golongan::create($request->all());
        return response()->json($golongan, 201);
    }

    public function show($id)
    {
        $golongan = Golongan::findOrFail($id);
        return response()->json($golongan);
    }

    public function update(Request $request, $id)
    {
        $golongan = Golongan::findOrFail($id);
        $golongan->update($request->all());
        return response()->json($golongan);
    }

    public function destroy($id)
    {
        Golongan::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
