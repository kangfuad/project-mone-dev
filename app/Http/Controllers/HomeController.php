<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\UtilFunction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            'auth',
            // 'verified'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        // dd($menu);
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda'
        ];
        return view('dashboard',['passing' => $passing]);
    }

    public function warehouse_spb(){
        $passing = [
            'title' => 'SPB - Penerimaan Barang',
            'title-page' => 'Penerimaan Barang'
        ];
        return view('PAGES.PAGES_WH.SPB.index', get_defined_vars());
    }

    public function mcc_rpu_index(){
        $passing = [
            'title' => 'RPU - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit'
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.index', get_defined_vars());
    }

    public function mcc_rpu_create(){
        $passing = [
            'title' => 'Buat - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit'
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.create', get_defined_vars());
    }
}
