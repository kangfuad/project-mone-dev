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
use App\Models\Mpe_master_barang;
use App\Models\Mpe_rpu_wo;
use App\Models\Mpe_rpu_keluhan_listbarang;
use App\Models\Mpe_rpu_sob;
use App\Models\Mpe_rpu_spb;
use App\Models\Mpe_sob;

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

    function createListingBarang($status, $req, $flaging)
    {
        if (count($req->barang) > 0) {
            foreach ($req->barang as $kl) {
                $c = explode("--&&--", $kl['kode_barang']);


                Mpe_rpu_keluhan_listbarang::create(
                    [
                        'no_rpu' => trim($req->no_rpu),
                        'id_mpe_rpu_keluhan' => trim($kl['id_keluhan']),
                        'kode_barang' => trim($c[0]),
                        'nama_barang' => trim($c[1]),
                        'jumlah_barang' => trim($kl['jumlah_barang']),
                        'id_mcc_created_keluhan' => trim($req->id_mcc),
                        'flaging' => trim($flaging),
                        'created_by' => Auth::user()->id
                    ]
                );
            }
        }

        $cek_keluhan_list = Mpe_rpu_keluhan_listbarang::where(['no_rpu' => $req->no_rpu, 'flaging' => $flaging, 'is_active' => 1])->get();

        if (count($cek_keluhan_list) == count($req->barang)) {
            // ['status id','no rpu','catatan','foto','id warehouse']
            $this->updatestatusrpu($status, $req->no_rpu, '', '', '');
            return true;
        } else {
            Mpe_rpu_keluhan_listbarang::where(['no_rpu' => $req->no_rpu, 'flaging' => $flaging, 'is_active' => 1])->delete();
            return false;
        }
        return false;
    }

    function create_sob($status, $req, $flaging)
    {
        $sob = new Mpe_rpu_sob();
        $sob->no_rpu = trim($req->no_rpu);
        $sob->id_sob = trim($req->no_sob);
        $sob->id_pic_wharehouse = trim($req->user_warehouse);
        $sob->flaging = trim($flaging);
        $sob->created_by = trim(Auth::user()->id);
        if ($sob->save()) {
            // ['status id','no rpu','catatan','foto','id warehouse']
            $this->updatestatusrpu($status, $req->no_rpu, '', '', $req->user_warehouse);
            return true;
        } else {
            return false;
        }
    }

    function updatestatusrpu($status, $no_rpu, $catatan, $foto, $pic_warehouse)
    {
        $rpu = Mpe_rpu::where('no_rpu', $no_rpu)
            ->update([
                'status_id' => $status,
                'updated_by' => Auth::user()->id
            ]);

        if ($rpu) {
            $this->insert_log($status, $no_rpu, '', '');
            return true;
        } else {
            return false;
        }
    }

    function insert_log($status, $rpu, $catatan, $foto)
    {

        $log = new Mpe_log();
        $log->no_rpu = trim($rpu);
        $log->role_id = trim(Auth::user()->role_id);
        $log->status_id = trim(isset($status) ? $status : '');
        $log->catatn = trim(isset($catatan) ? $catatan : '');
        $log->foto = trim(isset($foto) ? $foto : '');
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

    function get_master_barang()
    {
        $barang = Mpe_master_barang::OrderBy('nama_barang', 'ASC')->get();

        if (count($barang) > 0) {
            $barang = $barang;
        } else {
            $barang = "error";
        }

        return $barang;
    }
    // END AJAX HELPERS
}
