<?php

namespace App\Http\Controllers;
use App\Helpers\UtilFunction;

use Illuminate\Http\Request;

class warehouseController extends Controller
{
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
        return view('PAGES.PAGES_WH.SPB.index', ['passing' => $passing]);
    }

    public function purchase_order(){
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "Warehouse MENU";
        $passing = [
            'title' => 'Purchase Order',
            'title-page' => 'Halaman Purchase Order',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES..PAGES_WH.PO.index', ['passing' => $passing]);
    }

    public function purchase_order_create(){
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "Warehouse MENU";
        $passing = [
            'title' => 'Purchase Order',
            'title-page' => 'Halaman Purchase Order',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES..PAGES_WH.PO.create', ['passing' => $passing]);
    }
}
