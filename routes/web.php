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
use App\Http\Controllers\WerehoseController;
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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'role:1', 'PreventBackHistory'], 'prefix' => '/admin'], function () {
    Route::get('/', [AdminController::class, 'index']);

    Route::get('/menu-manajemen', [AdminController::class, 'menu_manajemen']);
});

Route::group(['middleware' => ['auth', 'role:2', 'PreventBackHistory'], 'prefix' => '/mcc'], function () {

    Route::get('/', [MccController::class, 'index']);
});


Route::group(['middleware' => ['auth', 'role:3', 'PreventBackHistory'], 'prefix' => '/foreman'], function () {

    Route::get('/', [ForemanController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'role:4', 'PreventBackHistory'], 'prefix' => '/werehose'], function () {

    Route::get('/', [WerehoseController::class, 'index']);
});
