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
