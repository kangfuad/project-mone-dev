<?php

namespace App\Http\Controllers;

use App\Helpers\UtilFunction;
use App\Helpers\ProsessFunction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
// Use Model
use App\Models\Mpe_master_barang;
use App\Models\Mpe_rpu;
use App\Models\Mpe_log;


class WarehouseController extends Controller
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
        return view('PAGES.PAGES_WH.index', ['passing' => $passing]);
    }

    // SPB
    public function spb()
    {
        $Until = new UtilFunction();
        $pf = new ProsessFunction();
        $menu = $Until->GET_MENU();
        $menu_head = "Warehouse MENU";
        $sob = $pf->GET_RPU_WITH_DETIL_BARANG_WITH_RELASI_STOCK(['20', '21', '23']);
        $spb = $pf->GET_RPU_WITH_DETIL_BARANG_WITH_RELASI_STOCK_SPB(['30', '31', '33']);
        // dd($spb);
        $passing = [
            'title' => 'SOB / SPB',
            'title-page' => 'Halaman SOB / SPB',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'sob' => $sob['sob'],
            'spb' => $spb['spb'],
            'until' => $Until
        ];
        return view('PAGES.PAGES_WH.SPB.index', ['passing' => $passing]);
    }


    // PO 
    public function purchase_order()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "Warehouse MENU";
        $passing = [
            'title' => 'Purchase Order',
            'title-page' => 'Halaman Purchase Order',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_WH.PO.index', ['passing' => $passing]);
    }

    public function purchase_order_create()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "Warehouse MENU";
        $passing = [
            'title' => 'Purchase Order',
            'title-page' => 'Halaman Purchase Order',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_WH.PO.create', ['passing' => $passing]);
    }

    // Inventory

    public function inventory()
    {
        $data = Mpe_master_barang::all();
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "Warehouse MENU";
        $passing = [
            'title' => 'Inventory',
            'title-page' => 'Halaman Inventory',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.PAGES_WH.INVENTORY.index', get_defined_vars());
    }

    // PROSES BACKEND
    function terima_sob(Request $req)
    {
        $pf = new ProsessFunction();
        $flaging = $pf->get_flaging($req->no_rpu) + 1;
        $create_spb = $pf->create_spb($req, $flaging);

        if ($create_spb == true) {
            $pesan = "SUCCESS";
        } else {
            $pesan = "ERROR";
        }
        return response()->json([
            'pesan' => $pesan,
        ]);
    }
    // END PROSES BACKEND
}
