<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonansController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::paginate(5); // Menggunakan paginate langsung pada query builder
        return view('permohonans', [
            'permohonan' => $permohonan,
            'currentPage' => 'Permohonan', 
        ]);    }
    

    public function destroy($id)
   {
    Permohonan::destroy($id);
    return redirect()->route('permohonans.index')->with('success', 'Permohonan deleted successfully.');
   }
}
