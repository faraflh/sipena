<?php

namespace App\Http\Controllers;

use App\Mail\PermohonanStatusMail;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PermohonansController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::paginate(5);
        return view('permohonans', [
            'permohonan' => $permohonan,
            'currentPage' => 'Permohonan', 
        ]);    }
    
        public function updateStatus(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = $request->input('status');
        
        if ($request->input('status') === 'Diterima') {
            $permohonan->generate_code = rand(100000, 999999); // Menghasilkan kode random
        } else {
            $permohonan->generate_code = null; // Reset kode jika status ditolak
        }

        $permohonan->save();

        // Persiapkan data untuk email
        $details = [
            'subject' => 'Status Permohonan Aplikasi',
            'nama_pemohon' => $permohonan->nama_pemohon,
            'nip' => $permohonan->nip,
            'nama_aplikasi' => $permohonan->nama_aplikasi,
            'nama_opd' => $permohonan->nama_opd,
            'nomor_telepon' => $permohonan->nomor_telepon,
            'email' => $permohonan->email,
            'message' => $permohonan->status === 'Diterima'
                ? 'Selamat! Permohonan aplikasi Anda telah diterima. Berikut adalah kode aplikasi Anda: ' . $permohonan->generate_code
                : 'Mohon Maaf! Permohonan aplikasi Anda telah ditolak.',
        ];

        // Kirim email
        Mail::to($permohonan->email)->send(new PermohonanStatusMail($details));

        return redirect()->route('permohonans.index')->with('success', 'Status permohonan berhasil diperbarui dan email telah dikirim.');
    }

    public function destroy($id)
   {
    Permohonan::destroy($id);
    return redirect()->route('permohonans.index')->with('success', 'Permohonan deleted successfully.');
   }
}