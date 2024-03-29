<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController, 
    EdukasiController,
    PengaduanController,
    DashboardController,
    KonsultasiController,
    DataStuntingController,
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

// Route::get('phpinfo', function() {
//     return phpinfo();
// });

// Route::get('firestore', function() {
//     $testRef = app('firebase.firestore')->database()->collection('Test')->newDocument();
//     $testRef->set([
//         'name' => 'todi',
//         'age' => 24
//     ]);
//     return 'ok';
// });

// Route::get('display', function() {
//     $firestore = app('firebase.firestore')->database();
//     $collection = $firestore->collection('Test');
//     $snapshot = $collection->documents();
//     $data = [];

//     foreach ($snapshot as $document) {
//         if ($document->exists()) {
//             // Dokumen ada
//             $data[] = $document->data();
//         } 
//     }

//     return $data;
// });

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login/proses', [LoginController::class, 'loginProses'])->name('login.proses');

Route::middleware('checkApiToken')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('edukasi', EdukasiController::class);

    Route::prefix('pengaduan/')->group(function() {
        Route::get('list', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('riwayat', [PengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
        Route::get('show/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    });

    Route::prefix('stunting')->group(function() {
        Route::get('list', [DataStuntingController::class, 'index'])->name('stunting.index');
    });

    Route::prefix('konsultasi/')->group(function() {
        Route::get('list', [KonsultasiController::class, 'index'])->name('konsultasi.index');
        Route::post('recent/message', [KonsultasiController::class, 'recentMessage'])->name('konsultasi.message');
        Route::get('riwayat', [KonsultasiController::class, 'riwayatKonsultasi'])->name('konsultasi.riwayat');
        Route::get('riwayat/{id}', [KonsultasiController::class, 'riwayatKonsultasiDetail'])->name('konsultasi.riwayat.detail');
        
    });

});