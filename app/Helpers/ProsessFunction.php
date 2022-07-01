<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


// MODELS
use App\Models\MasterMenu;
use App\Models\MasterSubMenu;
use App\Models\MasterRole;
use App\Models\MasterStatus;
use App\Models\Mpe_rpu;
use App\Models\Mpe_rpu_keluhan;
use App\Models\Mpe_log;
use App\Models\Mpe_rpu_wo;
use App\Models\Mpe_rpu_keluhan_listbarang;
use App\Models\Mpe_rpu_sob;
use App\Models\Mpe_rpu_spb;

// END MODELS


class ProsessFunction
{
    function get_flaging($no_rpu)
    {
        $id_user = Auth::user()->id;

        $wo = Mpe_rpu_wo::where(['no_rpu' => $no_rpu, 'is_active' => 1, 'created_by' => $id_user])->get();


        return count($wo);
    }

    function create($req, $flaging)
    {

        $rpu = new Mpe_rpu();
        $rpu->no_rpu = trim($req->no_rpu);
        $rpu->nomer_unit = trim($req->no_unit);
        $rpu->jenis_rpu = trim($req->jenis_rpu);
        $rpu->lokasi = trim($req->lokasi);
        $rpu->hm = trim($req->hour_meter);
        $rpu->km = trim($req->kilo_meter);
        $rpu->id_pic_foreman = trim($req->id_foreman);
        $rpu->status_id = 11;
        $rpu->created_by = Auth::user()->id;


        if (count($req->keluhan) > 0) {
            foreach ($req->keluhan as $kl) {

                Mpe_rpu_keluhan::create(
                    [
                        'no_rpu' => trim($req->no_rpu),
                        'keluhan' => trim($kl),
                        'keluhan_slug' => trim(Str::of($kl)->slug('-')),
                        'id_pic_foreman' => trim($req->id_foreman),
                        'flaging' => trim($flaging),
                        'created_by' => Auth::user()->id
                    ]
                );
            }
        }


        $cek_keluhan = Mpe_rpu_keluhan::where(['no_rpu' => $req->no_rpu, 'flaging' => $flaging, 'is_active' => 1])->get();

        if (count($cek_keluhan) == count($req->keluhan)) {
            if ($rpu->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            Mpe_rpu_keluhan::where(['no_rpu' => $req->no_rpu, 'flaging' => $flaging, 'is_active' => 1])->delete();
            Mpe_log::where(['no_rpu' => $req->no_rpu, 'flaging' => $flaging, 'is_active' => 1])->delete();
            return false;
        }

        Mpe_log::where(['no_rpu' => $req->no_rpu, 'flaging' => $flaging, 'is_active' => 1])->delete();
        return false;
    }

    function insert_log($status, $rpu, $catatan, $foto)
    {

        $log = new Mpe_log();
        $log->no_rpu = trim($rpu);
        $log->role_id = trim(Auth::user()->role_id);
        $log->status_id = trim(isset($status) ? $status : '');
        $log->catatn = trim(isset($foto) ? $catatan : '');
        $log->foto = trim($foto);
        $log->created_by = trim(Auth::user()->id);
        $log->save();
    }


    // AJAX HELPERS
    function get_keluhan_with_barang($no_rpu)
    {


        $keluhan = Mpe_rpu_keluhan::with(['barang'])->where(['no_rpu' => $no_rpu, 'is_active' => 1])->OrderBy('keluhan', 'ASC')->get();

        if (count($keluhan) > 0) {
            $keluhan = $keluhan;
        } else {
            $keluhan = "error";
        }

        return $keluhan;
    }
    // END AJAX HELPERS
}
