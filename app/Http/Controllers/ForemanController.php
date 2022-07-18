<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;
use App\Helpers\ProsessFunction;

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
        $rpus = $Until->GET_RPU('ANALISA-FOREMAN');
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
        $pf = new ProsessFunction();
        $menu = $Until->GET_MENU();
        $rpu = $Until->GET_RPU($no_rpu);
        $menu_head = "FOREMAN MENU";
        $barang = $pf->get_master_barang();
        // dd($barang);
        $passing = [
            'title' => 'Listing Barang',
            'title-page' => 'Listing Barang',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'rpu' => $rpu,
            'until' => $Until,
            'barang' => $barang


        ];
        return view('PAGES.PAGES_FM.FM_LISTING.create', ['passing' => $passing]);
    }

    public function post_list_barang_create(Request $req)
    {
        // dd($req->all());

        $pf = new ProsessFunction();
        $flaging = $pf->get_flaging($req->no_rpu) + 1;
        // $pf->insert_log(10, $req->no_rpu, '', '');
        if (count($req->barang) > 0) {
            $create = $pf->createListingBarang(12, $req, $flaging);
        } else {
            // ['status id','no rpu','catatan','foto','id warehouse']
            $create = $pf->updatestatusrpu(14, $req->no_rpu, '', '', '');
        }


        if ($create == true) {
            return redirect('/foreman/list-barang')->with('berhasil', 'Listing barang berhail di buat');
        } else {
            return redirect('/foreman/list-barang')->with('error', 'Listing barang gagal di buat, Silahkan coba kembali nanti!');
        }
    }
}
