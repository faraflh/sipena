<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\DetailAlur;
use App\Models\Alur;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AplikasiController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $aplikasi = Aplikasi::all();
            return DataTables::of($aplikasi)
                ->addIndexColumn()
                ->addColumn('kelola_tim', function ($row) {
                    return '<a href="' . route('manajemen-aplikasi.detailTim', $row->id) . '" class="btn btn-sm btn-warning text-center align-bottom"> 
                            Set Tim
                            </a>';
                })
                ->addColumn('kelola_dokumen', function ($row) {
                    return '<a href="' . route('manajemen-aplikasi.detailDokumen', $row->id) . '" class="btn btn-sm btn-warning text-center align-bottom"> 
                            Set Dokumen
                            </a>';
                })
                ->addColumn('kelola_alur', function ($row) {
                    return '<a href="' . route('manajemen-aplikasi.detailAlur', $row->id) . '" class="btn btn-sm btn-warning text-center align-bottom"> 
                            Set Alur
                            </a>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="javascript:void(0)" class="delete text-danger cursor-pointer" data-id="' . $row->id . '">
                        <i class="fas fa-trash-alt" title="Delete"></i>
                    </a>
                    <a href="javascript:void(0)" class="edit ms-4 text-dark cursor-pointer" data-id="' . $row->id . '" 
                    data-namaAplikasi="' . $row->namaAplikasi . '"
                    data-keterangan="' . $row->keterangan . '"
                           data-url="' . $row->url . '"
                           data-status="' . $row->status . '">
                        <i class="fas fa-pencil-alt" title="Edit"></i>
                    </a>';
                })
                ->rawColumns(['kelola_tim', 'kelola_alur', 'kelola_dokumen', 'action'])
                ->make(true);
        }

        return view('aplikasi', ['currentPage' => 'Manajemen Aplikasi']);
    }

    public function showDetailTim($id)
    {
        $aplikasi = Aplikasi::with('detailTim')->find($id);

        if (!$aplikasi || !$aplikasi->detailTim) {
            return redirect()->back()->with('error', 'Detail Tim tidak ditemukan.');
        }

        return view('manajemen-aplikasi.detailTim', [
            'currentPage' => 'Detail Alur',
            'detailTim' => $aplikasi->detailTim,
            'aplikasi' => $aplikasi
        ]);
    }

    public function detailTim($id)
    {
        $aplikasi = Aplikasi::findOrFail($id);
        $tim = $aplikasi->tim; 

        return view('manajemen-aplikasi.detailTim', [
            'currentPage' => 'Detail Tim',
            'aplikasi' => $aplikasi,
            'tim' => $tim
        ]);
    }

    
    public function showDetailDokumen($id)
    {
        $aplikasi = Aplikasi::with('detailDokumen')->find($id);
    
        if (!$aplikasi || !$aplikasi->detailDokumen) {
            return redirect()->back()->with('error', 'Detail Dokumen tidak ditemukan.');
        }
    
        return view('manajemen-aplikasi.detailDokumen', ['detailDokumen' => $aplikasi->detailDokumen, 'currentPage' => 'Detail Dokumen',
        'aplikasi' => $aplikasi,
    ]);
    }

    public function detailDokumen($id)
    {
        $aplikasi = Aplikasi::findOrFail($id);
        $dokumen = $aplikasi->dokumen;

        return view('manajemen-aplikasi.detailDokumen', ['currentPage' => 'Detail Dokumen',
            'aplikasi' => $aplikasi,
            'dokumen' => $dokumen
        ]);
    }
    
    public function showDetailAlur($id)
    {
        $aplikasi = Aplikasi::with('detailAlur')->find($id);

        if (!$aplikasi || !$aplikasi->detailAlur) {
            return redirect()->back()->with('error', 'Detail Alur tidak ditemukan.');
        }

        return view('manajemen-aplikasi.detailAlur', [
            'currentPage' => 'Detail Alur',
            'detailAlur' => $aplikasi->detailAlur,
            'aplikasi' => $aplikasi
        ]);
    }

    public function detailAlur($id)
    {
        $aplikasi = Aplikasi::findOrFail($id);
        $alur = Alur::all();

        return view('manajemen-aplikasi.detailAlur', [
            'currentPage' => 'Detail Alur',
            'aplikasi' => $aplikasi,
            'namaAplikasi' => $aplikasi->namaAplikasi,
            'alur' => $alur,
            'aplikasi_id' => $id 

        ]);
    }

    public function detailAlurData($id)
    {
        $query = DetailAlur::where('aplikasi_id', $id) 
            ->with('aplikasi', 'alur'); 

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aplikasi', function ($row) {
                return $row->aplikasi->namaAplikasi ?? '-';
            })
            ->addColumn('alur', function ($row) {
                return $row->alur->namaAlur ?? '-';
            })
            ->addColumn('action', function ($row) {
                return '
                <a href="javascript:void(0)" class="delete text-danger cursor-pointer" 
                            data-id="' . $row->id . '"
                            data-aplikasi_id="' . $row->aplikasi_id . '"
                            data-alur_id="' . $row->alur_id . '"
                            data-keterangan_alur="' . $row->keterangan_alur . '">
                            <i class="fas fa-trash-alt" title="Delete"></i>
                        </a>
                <a href="javascript:void(0)" class="edit  ms-4 text-dark cursor-pointer"
                            data-id="' . $row->id . '" 
                            data-aplikasi_id="' . $row->aplikasi_id . '"
                            data-alur_id="' . $row->alur_id . '"
                            data-keterangan_alur="' . ($row->keterangan_alur ?? '') . '">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                    </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaAplikasi' => 'required|string|max:30',
            'keterangan' => 'required|string|max:255',
            'detail_tim_id' => 'nullable|exists:detail_tims,id',
            'detail_dokumen_id' => 'nullable|exists:detail_dokumens,id',
            'detail_alur_id' => 'nullable|exists:detail_alurs,id',
            'url' => 'required|string|max:255',
            'status' => 'required|string|max:30',
        ]);
        
        Aplikasi::create([
            'namaAplikasi' => $request->namaAplikasi,
            'keterangan' => $request->keterangan,
            'detail_tim_id' => $request->detail_tim_id,
            'detail_dokumen_id' => $request->detail_dokumen_id,
            'detail_alur_id' => $request->detail_alur_id,
            'url' => $request->url,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Data berhasil ditambah!']);
    }

    public function edit($id)
    {
        $aplikasi = Aplikasi::find($id);
        return response()->json($aplikasi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaAplikasi' => 'required|string|max:30',
            'keterangan' => 'required|string|max:255',
            'detail_tim_id' => 'nullable|exists:detail_tims,id',
            'detail_dokumen_id' => 'nullable|exists:detail_dokumens,id',
            'detail_alur_id' => 'nullable|exists:detail_alurs,id',
            'url' => 'required|string|max:255',
            'status' => 'required|string|max:30',
        ]);

        $aplikasi = Aplikasi::find($id);
        $aplikasi->update([
            'namaAplikasi' => $request->namaAplikasi,
            'keterangan' => $request->keterangan,
            'detail_tim_id' => $request->detail_tim_id,
            'detail_dokumen_id' => $request->detail_dokumen_id,
            'detail_alur_id' => $request->detail_alur_id,
            'url' => $request->url,
            'status' => $request->status,       
        ]);
        return response()->json(['success' => 'Data berhasil diubah!']);
    }

    

    public function destroy($id)
    {
        Aplikasi::destroy($id);
        return response()->json(['success' => 'Data deleted successfully!']);
    }
    
}