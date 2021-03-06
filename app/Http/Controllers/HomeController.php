<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\UtilFunction;
use App\Helpers\ProsessFunction;

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
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU"; // dd($menu);
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('dashboard', ['passing' => $passing]);
    }

    public function warehouse_spb()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'SPB - Penerimaan Barang',
            'title-page' => 'Penerimaan Barang',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_WH.SPB.index', get_defined_vars());
    }

    // AJAX FUNCTION
    function get_kerusakan_with_barang(Request $req)
    {
        $pf = new ProsessFunction();
        $keluhan = $pf->get_keluhan_with_barang($req->no_rpu);

        if (count($keluhan) > 0) {
            $keluhan = $keluhan;
            $pesan = "sukses";
        } else {
            $keluhan = $keluhan;
            $pesan = "error";
        }

        return response()->json([
            'pesan' => $pesan,
            'data' => $keluhan
        ]);
    }

    function get_all_items(Request $req)
    {
        $pf = new ProsessFunction();
        $barang = $pf->get_master_barang();

        if (count($barang) > 0) {
            $barang = $barang;
            $pesan = "sukses";
        } else {
            $barang = $barang;
            $pesan = "error";
        }

        return response()->json([
            'pesan' => $pesan,
            'data' => $barang
        ]);
    }
    // END AJAX FUNCTION

}
