<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController, 
    EdukasiController,
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

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login/proses', [LoginController::class, 'loginProses'])->name('login.proses');

Route::middleware('checkApiToken')->group(function() {
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('edukasi', EdukasiController::class);
});