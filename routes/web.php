<?php

use App\Http\Controllers\AlurController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\JabatanStatusController;
use App\Http\Controllers\JabatanKegiatanController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/permohonan', function () {
    return view('permohonan');
});

Route::get('/jabatan-pegawai', function () {return view('dashboard');})->name('jabatan-pegawai');
Route::get('/manajemen-aplikasi', function () {return view('dashboard');})->name('manajemen-aplikasi');
Route::get('/manajemen-administrasi', function () {return view('dashboard');})->name('manajemen-administrasi');
Route::get('/settings', function () {return view('dashboard');})->name('settings');
Route::get('/alur', function () {return view('alur');})->name('alur');
Route::get('/pegawai', function () {return view('pegawai');})->name('pegawai');
Route::resource('pegawai', PegawaiController::class);
Route::resource('alur', AlurController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('jabatanStatus', JabatanStatusController::class);
Route::resource('jabatanKegiatan', JabatanKegiatanController::class);

Route::get('/', [PageController::class, 'index'])->name('home');


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [LoginController::class, 'creds'])->name('dashboard');

Route::post('/submit-form', [PermohonanController::class, 'submitForm'])->name('submitForm');

