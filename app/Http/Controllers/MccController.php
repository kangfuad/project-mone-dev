<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ProsessFunction;
use App\Helpers\UtilFunction;
use Illuminate\Support\Facades\DB;
// USE MODEL
use App\Models\User;
use App\Models\Mpe_rpu;
use App\Models\Mpe_rpu_keluhan;
use App\Models\Mpe_log;
use App\Models\Mpe_rpu_wo;
use App\Models\Mpe_rpu_keluhan_listbarang;
use App\Models\Mpe_rpu_sob;
use App\Models\Mpe_rpu_spb;
use App\Models\Master_unit;
use Illuminate\Support\Facades\Auth;

// END USE MODEL


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
        $rpus = Mpe_rpu::with(['foreman', 'status'])->where(['is_Active' => 1, 'created_by' => Auth::user()->id])->WhereIn('status_id', [11])->OrderBy('id', 'DESC')->get();
        $passing = [
            'title' => 'RPU - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'rpus' => $rpus
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.index', get_defined_vars());
    }

    public function mcc_rpu_create()
    {
        $GET_MENU = new UtilFunction();
        $pf = new ProsessFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $foreman = User::with(['count_foreman'])->where(['role_id' => 3, 'is_active' => 1])->OrderBy('name', 'ASC')->get();
        // dd(count($foreman[0]['count_foreman']));
        $unit_list = Mpe_rpu::select(['nomer_unit'])->where(['is_active' => 1])->whereNot('status_id', 100)->get();
        $units = Master_unit::where(['is_active' => 1])->whereNotIn('UNIT_ID', $unit_list)->OrderBy('UNIT_ID', 'ASC')->get();
        $barang = $pf->get_master_barang();
        $passing = [
            'title' => 'Buat - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'foreman' => $foreman,
            'units' => $units,
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.create', get_defined_vars());
    }

    public function mcc_rpu_post(request $request)
    {
        $pf = new ProsessFunction();
        $flaging = $pf->get_flaging($request->no_rpu) + 1;
        $pf->insert_log(10, $request->no_rpu, '', '');

        $create = $pf->create($request, $flaging);

        if ($create == true) {
            $pf->insert_log(11, $request->no_rpu, '', '');
            return redirect('/mcc/rpu')->with('berhasil', 'RPU berhail di buat');
        } else {
            return redirect('/mcc/rpu')->with('error', 'RPU gagal di buat, Silahkan coba kembali nanti!');
        }
    }

    public function mcc_sob_index()
    {
        $Until = new UtilFunction();
        $menu = $Until->GET_MENU();
        $menu_head = "ADMIN MENU";
        $sob = $Until->GET_RPU_WITH_DETIL_BARANG(['12']);
        $warehouse = User::with(['count_warehouse'])->where(['role_id' => 4, 'is_active' => 1])->OrderBy('name', 'ASC')->get();
        $passing = [
            'title' => 'Buat - Surat Order Barang',
            'title-page' => 'Order Barang',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'sob' => $sob,
            'until' => $Until,
            'warehouse' => $warehouse

        ];
        return view('PAGES.PAGES_MCC.MCC_SOB.index', get_defined_vars());
    }

    public function ajukan_sob(Request $req)
    {
        $pf = new ProsessFunction();
        $flaging = $pf->get_flaging($req->no_rpu) + 1;

        $create = $pf->create_sob(20, $req, $flaging);

        if ($create == true) {
            $pesan = "SUCCESS";
        } else {
            $pesan = "ERROR";
        }
        return response()->json([
            'pesan' => $pesan,
        ]);
    }

    public function mcc_wo_index(){
        $Until = new UtilFunction();
        $menu = $Until->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'WO - Work Order',
            'title-page' => 'Halaman Work Order',
            'menu' => $menu,
            'menu_head' => $menu_head

        ];
        return view('PAGES.PAGES_MCC.MCC_WO.index', get_defined_vars());
    }
}
