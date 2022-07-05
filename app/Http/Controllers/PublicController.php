<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;
use App\Models\Mpe_log;
use DB;

class PublicController extends Controller
{

    public function history_page($kode_rpu)
    {
        $menu_head = "ADMIN MENU"; // dd($menu);
        $Until = new UtilFunction();
        $logs = Mpe_log::with(['status', 'user', 'role'])->where(['no_rpu' => $kode_rpu, 'is_active' => 1])->OrderBy('created_at', 'ASC')->get();
        $passing = [
            'title' => 'History Unit',
            'title-page' => 'Halaman History',
            'logs' => $logs,
            'kode_rpu' => $kode_rpu,
            'until' => $Until,
            'menu_head' => $menu_head

        ];
        // $logs = DB::table('mpe_logs as a')
        //     ->join('master_statuses as b', 'a.status_id', 'b.id')
        //     ->where('no_rpu', $kode_rpu)
        //     ->get();

        return view('PAGES.HISTORY.index', compact('passing',));
    }
}
