<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// CONTROLLER
use App\Http\Controllers\HomeController;
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
Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');
// BERANDA

Route::group(['middleware' => ['auth', 'role:1', 'PreventBackHistory'], 'prefix' => '/admin'], function () {
    Route::get('/', [AdminController::class, 'index']);

    Route::get('/menu-manajemen', [AdminController::class, 'menu_manajemen']);
});

Route::group(['middleware' => ['auth', 'role:2', 'PreventBackHistory'], 'prefix' => '/mcc'], function () {

    Route::get('/', [MccController::class, 'index']);
    Route::get('/rpu/index', [HomeController::class, 'mcc_rpu_index'])->name('mcc.rpu.index');
    Route::get('/rpu/create', [HomeController::class, 'mcc_rpu_create'])->name('mcc.rpu.create');
});


Route::group(['middleware' => ['auth', 'role:3', 'PreventBackHistory'], 'prefix' => '/foreman'], function () {

    Route::get('/', [ForemanController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'role:4', 'PreventBackHistory'], 'prefix' => '/werehose'], function () {

    Route::get('/', [WerehoseController::class, 'index']);
    Route::get('/spb/index', [HomeController::class, 'warehouse_spb'])->name('warehouse.spb.index');
});