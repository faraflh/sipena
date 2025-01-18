<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
//    public function index()
//    {
//        return Permohonan::all();
//    }

    public function submitForm(Request $request)
    {
//        $data = $request->validate([
        $validatedData = $request->validate([

            'nama_pemohon' => ['required'],
            'nip' => ['required', 'numeric', 'digits_between:1,18'],
            'nomor_telepon' => ['required', 'max:15'],
            'nama_opd' => ['required'],
            'nama_aplikasi' => ['required'],
            'email' => ['required', 'email', 'max:254'],
        ]);

//        return Permohonan::create($data);
        Permohonan::create($validatedData);
        return redirect()->back()->with('success', 'Form berhasil dikirim!');
    }

//    public function show(Permohonan $permohonan)
//    {
//        return $permohonan;
//    }
//
//    public function update(Request $request, Permohonan $permohonan)
//    {
//        $data = $request->validate([
//            'nama_pemohon' => ['required'],
//            'nip' => ['required'],
//            'nomor_telepon' => ['required'],
//            'nama_opd' => ['required'],
//            'nama_aplikasi' => ['required'],
//            'email' => ['required', 'email', 'max:254'],
//        ]);
//
//        $permohonan->update($data);
//
//        return $permohonan;
//    }
//
//    public function destroy(Permohonan $permohonan)
//    {
//        $permohonan->delete();
//
//        return response()->json();
//    }
}
