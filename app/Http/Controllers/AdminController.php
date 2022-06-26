<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function index()
    {

        // $role = Auth::user()->role_id;

        // if ($role == "1") {
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
            return view('PAGES.ADMIN.index', ['passing' => $passing]);
        // } else if ($role == 2) {
        //     return redirect('/mcc');
        // } else if ($role == 3) {
        //     return redirect('/foreman');
        // } else if ($role == 4) {
        //     return redirect('/warehose');
        // } else {
        //     Session::flush();

        //     Auth::logout();

        //     return redirect('/');
        // }
    }

    public function dasboard()
    {
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
        return view('PAGES.ADMIN.index', ['passing' => $passing]);
    }

    public function menu_manajemen()
    {
        return "OKE SIP";
    }
}
