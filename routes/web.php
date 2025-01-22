<?php

use App\Http\Controllers\AlurController;
use App\Http\Controllers\DetailAlurController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DpaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\PermohonansController;
use App\Http\Controllers\JabatanStatusController;
use App\Http\Controllers\JabatanKegiatanController;
use App\Http\Controllers\KegiatanController;
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
// Route::get('/jabatan-kegiatan', function () {return view('dashboard');})->name('jabatan-kegiatan');
Route::get('/manajemen-aplikasi', function () {return view('dashboard');})->name('manajemen-aplikasi');
Route::get('/manajemen-administrasi', function () {return view('dashboard');})->name('manajemen-administrasi');
Route::get('/settings', function () {return view('dashboard');})->name('settings');
Route::resource('pegawai', PegawaiController::class);
Route::resource('alur', AlurController::class);
Route::resource('dpa', DpaController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('dokumen', DokumenController::class);
Route::resource('jabatanStatus', JabatanStatusController::class);
Route::resource('jabatanKegiatan', JabatanKegiatanController::class);
Route::resource('permohonans', PermohonansController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::prefix('manajemen-aplikasi')->group(function () {
    Route::resource('detailAlur', DetailAlurController::class);
});

Route::prefix('manajemen-aplikasi')->as('manajemen-aplikasi.')->group(function () {
    Route::resource('kegiatan', KegiatanController::class);
});

Route::get('/manajemen-aplikasi/kegiatan/data', [KegiatanController::class, 'getData'])->name('kegiatan.data');
Route::post('/permohonans/{id}/status', [PermohonansController::class, 'updateStatus'])->name('permohonans.updateStatus');

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [LoginController::class, 'creds'])->name('dashboard');
// Route::get('/permohonans', PermohonanController::class)->name('permohonans');

//Route::get('/permohonan', [PermohonanController::class, 'create'])->name('permohonan.create');
//Route::post('/permohonan', [PermohonanController::class, 'store'])->name('permohonan.submit');

Route::post('/submit-form', [PermohonanController::class, 'submitForm'])->name('submitForm');

