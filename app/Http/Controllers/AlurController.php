<?php

namespace App\Http\Controllers;

use App\Models\Alur;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlurController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $alur = Alur::all();
            return DataTables::of($alur)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                  <a href="javascript:void(0)" class="edit btn btn-info btn-xs" data-id="'.$row->id.'" data-namaAlur="'.$row->namaAlur.'">
    <i class="fas fa-edit"></i>
</a>
<a href="javascript:void(0)" class="delete btn btn-danger btn-xs" data-id="'.$row->id.'">
    <i class="fas fa-trash"></i>
</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('alur');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaAlur' => 'required|string|max:30',
        ]);

        Alur::create([
            'namaAlur' => $request->namaAlur,
        ]);

        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $alur = Alur::find($id);
        return response()->json($alur);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaAlur' => 'required|string|max:30',
        ]);

        $alur = Alur::find($id);
        $alur->update([
            'namaAlur' => $request->namaAlur,
        ]);

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        Alur::destroy($id);
        return response()->json(['success' => 'Data deleted successfully!']);
    }
}
