<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->to('/dashboard');
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
//        $credentials = [
//            'email' => $request->input('email'),
//            'password' => $request->input('password'),
//        ];
//
//        if (Auth::attempt($credentials, $request->filled('remember'))) {
//            return redirect()->to('/dashboard');
//        } else {

        $request->validate([
            'nip_nik' => 'required|string',
            'password' => 'required|string',
        ]);

        $nipNik = $request->nip_nik;
        $password = $request->password;

        $user = User::whereHas('pegawai', function ($query) use ($nipNik) {
            $query->where('nip_nik', $nipNik);
        })->first();

        if ($user && Auth::attempt(['id' => $user->id, 'password' => $password])) {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Email or password is incorrect');
        }
    }

    public function creds()
    {
        $user = Auth::user();

        $pegawai = $user->pegawai;

        return view('dashboard', [
            'user' => $user,
            'pegawai' => $pegawai,
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
}
