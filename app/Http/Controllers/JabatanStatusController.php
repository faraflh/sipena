<?php

namespace App\Http\Controllers;

use App\Models\JabatanStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class JabatanStatusController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jabatanStatus = JabatanStatus::all();
            return DataTables::of($jabatanStatus)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt" title="Delete"></i>
                        </a>
                        <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer" data-id="' . $row->id . '" data-namaJabatanStatus="' . $row->namaJabatanStatus . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                        </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('jabatanStatus', [
            'currentPage' => 'Jabatan Status',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaJabatanStatus' => 'required|string|max:30',
        ]);

        JabatanStatus::create([
            'namaJabatanStatus' => $request->namaJabatanStatus,
        ]);

        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $jabatanStatus = JabatanStatus::findOrFail($id);
        return response()->json($jabatanStatus);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaJabatanStatus' => 'required|string|max:30',
        ]);

        $jabatanStatus = JabatanStatus::findOrFail($id);
        $jabatanStatus->update([
            'namaJabatanStatus' => $request->namaJabatanStatus,
        ]);

        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id)
    {
        JabatanStatus::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}