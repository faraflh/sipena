<?php

namespace App\Http\Controllers;

use App\Models\Alur;
use Illuminate\Http\Request;

class AlurController extends Controller
{
    public function index(Request $request)
    {
        $query = Alur::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('namaAlur', 'like', '%' . $request->search . '%');
        }

        $alur = $query->get();

        return view('alur', [
            'alur' => $alur,
            'currentPage' => 'Alur', 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaAlur' => 'required|string|max:30',
        ]);

        Alur::create($request->all());
        return redirect()->route('alur.index')->with('success', 'Alur created successfully.');
    }

//    public function show($id)
//    {
//        $alur = Alur::findOrFail($id);
//        return response()->json($alur);
//    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaAlur' => 'required|string|max:30',
        ]);

        $alur = Alur::findOrFail($id);
        $alur->update($request->all());
        return redirect()->route('alur.index')->with('error', 'Alur update failed.');
    }

    public function destroy($id)
    {
        Alur::destroy($id);
        return redirect()->route('alur.index')->with('success', 'Alur deleted successfully.');
    }
}
