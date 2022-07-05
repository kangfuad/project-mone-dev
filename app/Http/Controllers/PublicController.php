<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;
use DB;

class PublicController extends Controller
{
    
    public function history_page($kode_rpu){
        $menu_head = "ADMIN MENU"; // dd($menu);
        $passing = [
            'title' => 'History Unit',
            'title-page' => 'Halaman History'
        ];
        $logs = DB::table('mpe_logs as a')
        ->join('master_statuses as b','a.status_id','b.id')
        ->where('no_rpu',$kode_rpu)
        ->get();

        return view('PAGES.HISTORY.index', compact('menu_head','passing','logs','kode_rpu'));
    }

}
