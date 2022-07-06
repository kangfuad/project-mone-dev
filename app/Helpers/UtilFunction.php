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
    // END DATE FORMATER
}
