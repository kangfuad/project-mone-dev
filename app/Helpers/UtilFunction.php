<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// MODELS
use App\Models\MasterMenu;
use App\Models\MasterSubMenu;
use App\Models\MasterRole;
use App\Models\MasterStatus;
use App\Models\Mpe_rpu;
use App\Models\Mpe_rpu_keluhan_listbarang;
use App\Models\Mpe_master_barang;
use App\Models\Mpe_log;

// END MODELS


class UtilFunction
{
    function GET_MENU()
    {
        $role_user = Auth::user()->role_id;

        $menu = MasterSubMenu::where(['role_id' => $role_user, 'is_active' => 1])->OrderBy('nama_sub_menu', 'ASC')->get();


        return $menu;
    }

    function GET_RPU($no_rpu)
    {
        if ($no_rpu == 'ALL') {
            $rpu = Mpe_rpu::with(['mcc', 'keluhan'])->where(['is_active' => 1])->OrderBy('updated_at', 'DESC')->get();
        } else if ($no_rpu == 'ANALISA-FOREMAN') {
            $rpu = Mpe_rpu::with(['mcc', 'keluhan'])->where(['status_id' => 11, 'id_pic_foreman' => Auth::user()->id, 'is_active' => 1])->OrderBy('updated_at', 'DESC')->get();
        } else {
            $rpu = Mpe_rpu::with(['mcc', 'keluhan'])->where(['no_rpu' => $no_rpu, 'is_active' => 1])->OrderBy('updated_at', 'DESC')->first();
        }

        return $rpu;
    }

    function GET_RPU_WITH_DETIL_BARANG($status)
    {
        $rpus = Mpe_rpu::with(['foreman', 'status', 'keluhan', 'listing'])->where(['is_Active' => 1, 'created_by' => Auth::user()->id])->whereIn('status_id', $status)->OrderBy('id', 'DESC')->get();
        $sob = [];
        foreach ($rpus as $rpu) {
            $push = [
                "id" => $rpu->id,
                "no_rpu" => $rpu->no_rpu,
                "nomer_unit" => $rpu->nomer_unit,
                "jenis_rpu" => $rpu->jenis_rpu,
                "lokasi" => $rpu->lokasi,
                "hm" => $rpu->hm,
                "km" => $rpu->km,
                "id_pic_foreman" => $rpu->id_pic_foreman,
                "status_id" => $rpu->status_id,
                "is_active" => $rpu->is_active,
                "created_by" => $rpu->created_by,
                "updated_by" => $rpu->updated_by,
                "created_at" => $rpu->created_at,
                "updated_at" => $rpu->updated_at,
                "pic_foreman" => $rpu['foreman']['name'],
            ];
            $i = 0;
            foreach ($rpu['keluhan'] as $keluhan) {
                $push['keluhan'][] = [
                    'keluhan' => $keluhan['keluhan'],
                ];
                $list = Mpe_rpu_keluhan_listbarang::where(['is_Active' => 1, 'id_mpe_rpu_keluhan' => $keluhan['id']])->get()->toArray();
                foreach ($list as $ls) {
                    $push['keluhan'][$i]['listing'][] = [
                        'nama_barang' => $ls['nama_barang'],
                        'kode_barang' => $ls['kode_barang']
                    ];
                }
                $i++;
            }
            $sob['sob'][] = $push;
        }

        return $sob;
    }

    // DATE FORMATER
    public function __construct()
    {
        if (!isset($GLOBALS["date_day_id"])) $GLOBALS["date_day_id"] = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        if (!isset($GLOBALS["date_month_id"])) $GLOBALS["date_month_id"] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        if (!isset($GLOBALS["date_month_en"])) $GLOBALS["date_month_en"] = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        if (!isset($GLOBALS["date_simple_month_id"])) $GLOBALS["date_simple_month_id"] = array("JAN", "FEB", "MAR", "APR", "MEI", "JUNI", "JULI", "AUG", "SEPT", "OKT", "NOV", "DES");
        if (!isset($GLOBALS["date_simple_month"])) $GLOBALS["date_simple_month"] = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
    }

    function date_reformat($format = "", $strdate = "")
    {
        return @date($format, @strtotime($strdate));
    }


    function hari_tanggal($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return $date_day_id[date("w", $sttime)] . ", " . date("j", $sttime) . " " . $date_month_id[date("n", $sttime) - 1] . " " . date("Y", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function tanggal($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return date("j", $sttime) . " " . $date_month_id[date("n", $sttime) - 1] . " " . date("Y", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function hari_tanggal_jam($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return date("j", $sttime) . " " . $date_month_id[date("n", $sttime) - 1] . " " . date("Y", $sttime) . ' - ' . date("H:i:s", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function jam_menit($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return date("H:i", $sttime);
        } else {
            return date("l, F j Y");
        }
    }
    // END DATE FORMATER
}
