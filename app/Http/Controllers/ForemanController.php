<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;

class ForemanController extends Controller
{
    public function index()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "FOREMAN MENU";
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_FM.index', ['passing' => $passing]);
    }

    public function list_barang()
    {
        $Until = new UtilFunction();
        $menu = $Until->GET_MENU();
        $rpus = $Until->GET_RPU('ALL');
        $menu_head = "FOREMAN MENU";
        $passing = [
            'title' => 'Listing Barang',
            'title-page' => 'Listing Barang',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'rpus' => $rpus,
            'until' => $Until
        ];

        // dd($passing);
        return view('PAGES.PAGES_FM.FM_LISTING.index', ['passing' => $passing]);
    }

    public function list_barang_create($no_rpu)
    {
        $Until = new UtilFunction();
        $menu = $Until->GET_MENU();
        $rpu = $Until->GET_RPU($no_rpu);
        $menu_head = "FOREMAN MENU";
        $passing = [
            'title' => 'Listing Barang',
            'title-page' => 'Listing Barang',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'rpu' => $rpu,
            'until' => $Until

        ];
        return view('PAGES.PAGES_FM.FM_LISTING.create', ['passing' => $passing]);
    }
}
