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
}
