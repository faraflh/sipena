<?php

use App\Http\Controllers\AlurController;
use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\DetailAlurController;
use App\Http\Controllers\DetailDokumenController;
use App\Http\Controllers\DetailTimController;
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


Route::get('/manajemen-aplikasi/{id}/dokumen', [AplikasiController::class, 'detailDokumen'])
->name('manajemen-aplikasi.detailDokumen');

Route::get('/manajemen-aplikasi/{id}/detail-dokumen/data', [AplikasiController::class, 'detailDokumenData'])
    ->name('manajemen-aplikasi.detailDokumenData');

Route::get('/manajemen-aplikasi/{id}/detail-alur', [AplikasiController::class, 'detailAlur'])
    ->name('manajemen-aplikasi.detailAlur');

Route::get('/manajemen-aplikasi/{id}/detail-alur/data', [AplikasiController::class, 'detailAlurData'])
    ->name('manajemen-aplikasi.detailAlurData');

Route::get('/manajemen-aplikasi/{id}/tim', [AplikasiController::class, 'detailTim'])
    ->name('manajemen-aplikasi.detailTim');

Route::get('/manajemen-aplikasi/{id}/detail-tim/data', [AplikasiController::class, 'detailTimData'])
    ->name('manajemen-aplikasi.detailTimData');

Route::get('/manajemen-aplikasi', function () {return view('dashboard');})->name('manajemen-aplikasi');
Route::get('/manajemen-administrasi', function () {return view('dashboard');})->name('manajemen-administrasi');
Route::get('/settings', function () {return view('dashboard');})->name('settings');
Route::resource('dpa', DpaController::class);
Route::resource('kategori', KategoriController::class);

Route::resource('dokumen', DokumenController::class);
Route::get('/dokumen/dropdown-data', [DokumenController::class, 'getDropdownData'])->name('dokumen.dropdownData');

Route::resource('jabatanStatus', JabatanStatusController::class);
Route::resource('jabatanKegiatan', JabatanKegiatanController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('alur', AlurController::class);
Route::resource('permohonans', PermohonansController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('manajemen-aplikasi', AplikasiController::class);
Route::resource('detailAlur', DetailAlurController::class);
Route::resource('detailTim', DetailTimController::class);
Route::resource('detailDokumen', DetailDokumenController::class);

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

