<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController, 
    EdukasiController,
    PengaduanController,
    DashboardController,
    KonsultasiController,
};

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

// Route::get('/', function() {
//     return redirect('chat');
// });

// Route::get('info', function() {
//     return PHP_VERSION;
// })->name('dashboard');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login/proses', [LoginController::class, 'loginProses'])->name('login.proses');

Route::middleware('checkApiToken')->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('edukasi', EdukasiController::class);

    Route::prefix('pengajuan/')->group(function() {
        Route::get('list', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('riwayat', [PengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
        Route::get('show/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::get('approve/{id}', [PengaduanController::class, 'approve'])->name('approve.update');
        Route::get('reject/{id}', [PengaduanController::class, 'reject'])->name('reject.update');
    });

    Route::prefix('konsultasi/')->group(function() {
        Route::get('list', [KonsultasiController::class, 'index'])->name('konsultasi.index');
        Route::get('recent/message/{id}', [KonsultasiController::class, 'recentMessage'])->name('konsultasi.message');
    });

    Route::get('chat', function() {
        return view('pages.konsultasi.form-chat');
    });


});