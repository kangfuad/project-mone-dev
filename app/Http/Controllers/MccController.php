<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;

class MccController extends Controller
{
    //
    public function index()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "MCC MENU";
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_MCC.index', ['passing' => $passing]);
    }

    public function mcc_rpu_index()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'RPU - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.index', get_defined_vars());
    }

    public function mcc_rpu_create()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'Buat - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.create', get_defined_vars());
    }

    public function mcc_rpu_post(request $request){
        dd($request->all());
        
    }

    public function mcc_sob_index(){
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'Buat - Surat Order Barang',
            'title-page' => 'Order Barang',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_MCC.MCC_SOB.index', get_defined_vars());
    }
}
