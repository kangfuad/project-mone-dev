<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// CONTROLLER
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
// END CONTROLLER

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
    $title = "Halaman Masuk";
    return view('index', ['title' => $title]);
});

Auth::routes(['verify' => true]);

// BERANDA
// Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');
// BERANDA



Route::group(['middleware' => ['auth', 'role:1']], function () {

        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        
        //semua route dalam grup ini hanya bisa diakses siswa
});

Route::group(['middleware' => ['auth', 'role:2']], function () {

    Route::get('/mcc', [AdminController::class, 'index'])->name('admin');
    
    //semua route dalam grup ini hanya bisa diakses siswa
});