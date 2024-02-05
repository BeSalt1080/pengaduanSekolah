<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TanggapanController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $kategoris = Kategori::latest()->get();
    return Inertia::render('Welcome', ['kategoris' => $kategoris]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('siswa', SiswaController::class);
    Route::resource('kategori', KategoriController::class);
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::resource('tanggapan', TanggapanController::class);
});

Route::resource('aspirasi', AspirasiController::class)->only(['store','show']);
Route::get('/profil', [AspirasiController::class,'profil'])->name('profil');

require __DIR__.'/auth.php';
