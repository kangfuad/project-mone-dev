<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;

class AdminController extends Controller
{
    public function index(){
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        // dd($menu);
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.ADMIN.index',['passing' => $passing]);
    }

    public function menu_manajemen(){
        return "OKE SIP";
    }
}
