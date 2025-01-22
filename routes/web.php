<?php

use App\Http\Controllers\AlurController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PermohonanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/permohonan', function () {
    return view('permohonan');
});

//Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
Route::get('/jabatan-kegiatan', function () {return view('dashboard');})->name('jabatan-kegiatan');
Route::get('/jabatan-pegawai', function () {return view('dashboard');})->name('jabatan-pegawai');
Route::get('/jabatan-status', function () {return view('dashboard');})->name('jabatan-status');
Route::get('/manajemen-aplikasi', function () {return view('dashboard');})->name('manajemen-aplikasi');
Route::get('/manajemen-administrasi', function () {return view('dashboard');})->name('manajemen-administrasi');
Route::get('/settings', function () {return view('dashboard');})->name('settings');
Route::get('/alur', function () {return view('alur');})->name('alur');
Route::get('/kategori', function () {return view('kategori');})->name('kategori');
Route::get('/pegawai', function () {return view('pegawai');})->name('pegawai');
Route::get('/dokumen', function () {return view('dokumen');})->name('dokumen');
//Route::resource('/pegawai', PegawaiController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('alur', AlurController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('dokumen', DokumenController::class);


Route::get('/', [PageController::class, 'index'])->name('home');

//Route::get('/login', function () {
//    return view('login');
//});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [LoginController::class, 'creds'])->name('dashboard');

//Route::get('/permohonan', [PermohonanController::class, 'create'])->name('permohonan.create');
//Route::post('/permohonan', [PermohonanController::class, 'store'])->name('permohonan.submit');

Route::post('/submit-form', [PermohonanController::class, 'submitForm'])->name('submitForm');

// push