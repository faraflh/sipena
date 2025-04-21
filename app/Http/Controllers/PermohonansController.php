<?php

namespace App\Http\Controllers;

use App\Mail\PermohonanStatusMail;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class PermohonansController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permohonan = Permohonan::all();
            return DataTables::of($permohonan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="javascript:void(0)" class="view text-dark cursor-pointer" data-id="' . $row->id . '">
                                <i class="fas fa-eye" title="Detail"></i>
                            </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('permohonans', ['currentPage' => 'Permohonan']);
    }

    public function updateStatus(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = $request->input('status');
        if ($request->input('status') === 'Diterima') {
            $permohonan->generate_code = rand(100000, 999999);
        } else {
            $permohonan->generate_code = null;
        }
        $permohonan->save();

        $details = [
            'subject' => 'Status Permohonan Aplikasi',
            'nama_pemohon' => $permohonan->nama_pemohon,
            'nip' => $permohonan->nip,
            'nomor_telepon' => $permohonan->nomor_telepon,
            'nama_opd' => $permohonan->nama_opd,
            'nama_aplikasi' => $permohonan->nama_aplikasi,
            'email' => $permohonan->email,
            'message' => $permohonan->status === 'Diterima'
                ? 'Selamat! Permohonan aplikasi Anda telah diterima. Berikut adalah kode aplikasi Anda: ' . $permohonan->generate_code
                : 'Mohon Maaf! Permohonan aplikasi Anda telah ditolak.',
        ];
        Mail::to($permohonan->email)->send(new PermohonanStatusMail($details));
        return response()->json(['success' => 'Status permohonan berhasil diperbarui dan email telah dikirim.']);
    }

    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        
        return response()->json($permohonan);
    }
}

?>