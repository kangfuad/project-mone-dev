<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ProsessFunction;
use App\Helpers\UtilFunction;

// USE MODEL
use App\Models\User;
use App\Models\Mpe_rpu;
use App\Models\Mpe_rpu_keluhan;
use App\Models\Mpe_log;
use App\Models\Mpe_rpu_wo;
use App\Models\Mpe_rpu_keluhan_listbarang;
use App\Models\Mpe_rpu_sob;
use App\Models\Mpe_rpu_spb;
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
        $rpus = Mpe_rpu::with(['foreman'])->where(['is_Active' => 1, 'created_by' => Auth::user()->id])->OrderBy('id','DESC')->get();
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
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $foreman = User::where(['role_id' => 3, 'is_active' => 1])->OrderBy('name', 'ASC')->get();
        $passing = [
            'title' => 'Buat - Request Perbaikan Unit',
            'title-page' => 'Request Perbaikan Unit',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'foreman' => $foreman
        ];
        return view('PAGES.PAGES_MCC.MCC_RPU.create', get_defined_vars());
    }

    public function mcc_rpu_post(request $request)
    {
        $pf = new ProsessFunction();
        $flaging = $pf->get_flaging($request->no_rpu) + 1;
        $pf->insert_log(10, $request->no_rpu,'','');

        $create = $pf->create($request, $flaging);

        if ($create == true) {
            $pf->insert_log(11, $request->no_rpu,'','');
            return redirect('/mcc/rpu')->with('berhasil', 'RPU berhail di buat');
        } else {
            return redirect('/mcc/rpu')->with('error', 'RPU gagal di buat, Silahkan coba kembali nanti!');
        }
    }
}
