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

Route::group(['prefix' => '/warehouse'], function(){
    Route::get('/spb/index', [HomeController::class, 'warehouse_spb'])->name('warehouse.spb.index');
});
Route::group(['prefix' => '/mcc'], function(){
    Route::get('/rpu/index', [HomeController::class, 'mcc_rpu_index'])->name('mcc.rpu.index');
});






// Group Routing FM start

Route::group(['prefix' => '/foreman'], function(){

    Route::get('/listing', function () {
        $passing = [
            'title'=>'Listing',
            'title-page'=>'Foreman'
        ];
        return view('PAGES.PAGES_FM.LISTING.index',['passing'=>$passing]); 
    });

});

// Group Routing FM end