<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UtilFunction;

// CONTROLLER
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MccController;
use App\Http\Controllers\ForemanController;
use App\Http\Controllers\warehouseController;
use App\Http\Controllers\PublicController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');

// History
Route::get('/history/{kode_rpu}', [PublicController::class, 'history_page'])->name('history.page');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'role:1', 'PreventBackHistory'], 'prefix' => '/admin'], function () {
    Route::get('/', [AdminController::class, 'index']);

    // Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/menu-manajemen', [AdminController::class, 'menu_manajemen']);
    Route::post('/menu-manajemen', [AdminController::class, 'tambah_menu_manajemen']);
    Route::post('/menu-ubah', [AdminController::class, 'ubah_menu_manajemen']);
    Route::post('/menu-hapus', [AdminController::class, 'hapus_menu_manajemen']);

    Route::get('/user-manajemen', [AdminController::class, 'user_manajemen']);
    Route::post('/user-manajemen', [AdminController::class, 'tambah_user_manajemen']);
    Route::get('/icon', [AdminController::class, 'icon']);

    Route::get('/unit-manajemen', [AdminController::class, 'unit_manajemen'])->name('unit.index');
    Route::get('/unit-manajemen-create', [AdminController::class, 'unit_manajemen_create'])->name('unit.create');

    Route::get('/satuan-manajemen', [AdminController::class, 'satuan_manajemen']);
});

Route::group(['middleware' => ['auth', 'role:2', 'PreventBackHistory'], 'prefix' => '/mcc'], function () {

    Route::get('/', [MccController::class, 'index']);
    Route::get('/rpu', [MccController::class, 'mcc_rpu_index'])->name('mcc.rpu.index');
    Route::get('/rpu/create', [MccController::class, 'mcc_rpu_create'])->name('mcc.rpu.create');
    Route::post('/rpu/post', [MccController::class, 'mcc_rpu_post'])->name('mcc.rpu.post');
    Route::get('/sob', [MccController::class, 'mcc_sob_index'])->name('mcc.sob.index');



    // END AJAX
});

Route::group(['middleware' => ['auth', 'role:3', 'PreventBackHistory'], 'prefix' => '/foreman'], function () {

    Route::get('/', [ForemanController::class, 'index']);
    Route::get('/list-barang', [ForemanController::class, 'list_barang'])->name('list.barang');
    Route::get('/list-barang/create/{no_rpu}', [ForemanController::class, 'list_barang_create'])->name('list.barang.create');
    Route::post('/list-barang/create', [ForemanController::class, 'post_list_barang_create'])->name('post.list.barang');
});

Route::group(['middleware' => ['auth', 'role:4', 'PreventBackHistory'], 'prefix' => '/warehouse'], function () {

    Route::get('/', [warehouseController::class, 'index']);
    Route::get('/spb/index', [warehouseController::class, 'warehouse_spb'])->name('warehouse.spb.index');
});


// AJAX
Route::post('/get-kerusakan-with-barang', [HomeController::class, 'get_kerusakan_with_barang'])->name('get.kerusakan.with.barang');
Route::post('/get-all-items', [HomeController::class, 'get_all_items'])->name('get.all.items');

// Test
Route::get('/get-all-items1', [HomeController::class, 'get_all_items'])->name('get.all.items1');
