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
            $this->updatestatusrpu($status, $req->no_rpu, '', '', $req->user_warehouse);
            return true;
        } else {
            return false;
        }
    }

    function updatestatusrpu($status, $no_rpu, $catatan, $foto, $userwarehouse)
    {
        $rpu = Mpe_rpu::where('no_rpu', $no_rpu)
            ->update([
                'status_id' => $status,
                'id_pic_wharehouse' => $userwarehouse,
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
        $log->catatan = trim(isset($catatan) ? $catatan : '');
        $log->foto = trim(isset($foto) ? $foto : '');
        $log->created_by = trim(Auth::user()->id);
        $log->save();
    }


    // PROSES IN WAREHOUSE
    function GET_RPU_WITH_DETIL_BARANG_WITH_RELASI_STOCK($status)
    {
        $rpus = Mpe_rpu::with(['foreman', 'status', 'listing', 'sob'])->where(['is_Active' => 1, 'id_pic_wharehouse' => Auth::user()->id])->whereIn('status_id', $status)->OrderBy('id', 'DESC')->get();
        $sob = [];
        foreach ($rpus as $rpu) {
            $push = [];

            $i = 0;
            foreach ($rpu['listing'] as $list) {
                $stock = Mpe_master_barang::where(['kode_barang' => $list['kode_barang'], 'is_Active' => 1])->first();
                if ($list['jumlah_barang'] > $stock['jumlah']) {
                    $triger = "1";
                    Mpe_master_barang::where('kode_barang', $list['kode_barang'])
                        ->update([
                            'flaging_po' => 1,
                            'updated_by' => Auth::user()->id
                        ]);
                    $i++;
                } else {
                    $triger = "0";
                }

                $push['listing'][] = [
                    'nama_barang' => $list['nama_barang'],
                    'kode_barang' => $list['kode_barang'],
                    'req_stock' => $list['jumlah_barang'],
                    'stock' => $stock['jumlah'],
                    'triger' => $triger
                ];
            }

            if ($i > 0) {
                Mpe_rpu::where('no_rpu', $rpu->no_rpu)
                    ->update([
                        'status_id' => '23',
                        'updated_by' => Auth::user()->id
                    ]);

                $cekLog = Mpe_log::where(['no_rpu' => $rpu->no_rpu, 'status_id' => 23, 'is_active' => 1])->get();
                // dd($cekLog);
                if (count($cekLog) == 0) {
                    $log = new Mpe_log();
                    $log->no_rpu = trim($rpu->no_rpu);
                    $log->role_id = trim(Auth::user()->role_id);
                    $log->status_id = '23';
                    $log->catatan = "Menunggu ketersediaan stock dalam gudang.";
                    $log->foto = trim(isset($foto) ? $foto : '');
                    $log->created_by = trim(Auth::user()->id);
                    $log->save();
                }

                $push['data'] = [
                    "id" => $rpu->id,
                    "no_rpu" => $rpu->no_rpu,
                    "nomer_unit" => $rpu->nomer_unit,
                    "jenis_rpu" => $rpu->jenis_rpu,
                    "lokasi" => $rpu->lokasi,
                    "hm" => $rpu->hm,
                    "km" => $rpu->km,
                    "id_pic_foreman" => $rpu->id_pic_foreman,
                    "status_id" => 23,
                    'status' => $rpu['status']['deskripsi_status'],
                    "is_active" => $rpu->is_active,
                    "created_by" => $rpu->created_by,
                    "updated_by" => $rpu->updated_by,
                    "created_at" => $rpu->created_at,
                    "updated_at" => $rpu->updated_at,
                    "pic_foreman" => $rpu['foreman']['name'],
                    "id_sob" => $rpu['sob']['id_sob'],
                    "tgl_sob" => $rpu['sob']['created_at'],
                ];
            } else {
                Mpe_rpu::where('no_rpu', $rpu->no_rpu)
                    ->update([
                        'status_id' => '21',
                        'updated_by' => Auth::user()->id
                    ]);
                $cekLog = Mpe_log::where(['no_rpu' => $rpu->no_rpu, 'status_id' => 21, 'is_active' => 1])->get();
                // dd($cekLog);
                if (count($cekLog) == 0) {
                    $log = new Mpe_log();
                    $log->no_rpu = trim($rpu->no_rpu);
                    $log->role_id = trim(Auth::user()->role_id);
                    $log->status_id = '21';
                    $log->foto = trim(isset($foto) ? $foto : '');
                    $log->created_by = trim(Auth::user()->id);
                    $log->save();
                }
                $push['data'] = [
                    "id" => $rpu->id,
                    "no_rpu" => $rpu->no_rpu,
                    "nomer_unit" => $rpu->nomer_unit,
                    "jenis_rpu" => $rpu->jenis_rpu,
                    "lokasi" => $rpu->lokasi,
                    "hm" => $rpu->hm,
                    "km" => $rpu->km,
                    "id_pic_foreman" => $rpu->id_pic_foreman,
                    "status_id" => 21,
                    'status' => $rpu['status']['deskripsi_status'],
                    "is_active" => $rpu->is_active,
                    "created_by" => $rpu->created_by,
                    "updated_by" => $rpu->updated_by,
                    "created_at" => $rpu->created_at,
                    "updated_at" => $rpu->updated_at,
                    "pic_foreman" => $rpu['foreman']['name'],
                    "id_sob" => $rpu['sob']['id_sob'],
                    "tgl_sob" => $rpu['sob']['created_at'],
                ];
            }


            $sob['sob'][] = $push;
        }

        return $sob;
    }

    function GET_RPU_WITH_DETIL_BARANG_WITH_RELASI_STOCK_SPB($status)
    {
        $rpus = Mpe_rpu::with(['mcc', 'status', 'listing', 'sob', 'spb'])->where(['is_Active' => 1, 'id_pic_wharehouse' => Auth::user()->id])->whereIn('status_id', $status)->OrderBy('id', 'DESC')->get();
        $spb = [];
        foreach ($rpus as $rpu) {
            $push = [];

            $i = 0;
            foreach ($rpu['listing'] as $list) {
                $stock = Mpe_master_barang::where(['kode_barang' => $list['kode_barang'], 'is_Active' => 1])->first();
                if ($list['jumlah_barang'] > $stock['jumlah']) {
                    $triger = "1";
                    Mpe_master_barang::where('kode_barang', $list['kode_barang'])
                        ->update([
                            'flaging_po' => 1,
                            'updated_by' => Auth::user()->id
                        ]);
                    $i++;
                } else {
                    $triger = "0";
                }

                $push['listing'][] = [
                    'nama_barang' => $list['nama_barang'],
                    'kode_barang' => $list['kode_barang'],
                    'req_stock' => $list['jumlah_barang'],
                    'stock' => $stock['jumlah'],
                    'triger' => $triger
                ];
            }

            if ($i > 0) {
                Mpe_rpu::where('no_rpu', $rpu->no_rpu)
                    ->update([
                        'status_id' => '23',
                        'updated_by' => Auth::user()->id
                    ]);

                $cekLog = Mpe_log::where(['no_rpu' => $rpu->no_rpu, 'status_id' => 23, 'is_active' => 1])->get();
                // dd($cekLog);
                if (count($cekLog) == 0) {
                    $log = new Mpe_log();
                    $log->no_rpu = trim($rpu->no_rpu);
                    $log->role_id = trim(Auth::user()->role_id);
                    $log->status_id = '23';
                    $log->catatan = "Menunggu ketersediaan stock dalam gudang.";
                    $log->foto = trim(isset($foto) ? $foto : '');
                    $log->created_by = trim(Auth::user()->id);
                    $log->save();
                }

                $push['data'] = [
                    "id" => $rpu->id,
                    "no_rpu" => $rpu->no_rpu,
                    "nomer_unit" => $rpu->nomer_unit,
                    "jenis_rpu" => $rpu->jenis_rpu,
                    "lokasi" => $rpu->lokasi,
                    "hm" => $rpu->hm,
                    "km" => $rpu->km,
                    "id_pic_foreman" => $rpu->id_pic_foreman,
                    "status_id" => 23,
                    'status' => $rpu['status']['deskripsi_status'],
                    "is_active" => $rpu->is_active,
                    "created_by" => $rpu->created_by,
                    "updated_by" => $rpu->updated_by,
                    "created_at" => $rpu->created_at,
                    "updated_at" => $rpu->updated_at,
                    "pic_foreman" => $rpu['foreman']['name'],
                    "id_sob" => $rpu['sob']['id_sob'],
                    "tgl_sob" => $rpu['sob']['created_at'],
                    "id_spb" => $rpu['spb']['id_spb'],
                    "tgl_spb" => $rpu['spb']['created_at'],
                    "pic_mcc" => $rpu['mcc']['name']
                ];
            } else {
                $push['data'] = [
                    "id" => $rpu->id,
                    "no_rpu" => $rpu->no_rpu,
                    "nomer_unit" => $rpu->nomer_unit,
                    "jenis_rpu" => $rpu->jenis_rpu,
                    "lokasi" => $rpu->lokasi,
                    "hm" => $rpu->hm,
                    "km" => $rpu->km,
                    "id_pic_foreman" => $rpu->id_pic_foreman,
                    'status' => $rpu['status']['deskripsi_status'],
                    "is_active" => $rpu->is_active,
                    "created_by" => $rpu->created_by,
                    "updated_by" => $rpu->updated_by,
                    "created_at" => $rpu->created_at,
                    "updated_at" => $rpu->updated_at,
                    "pic_foreman" => $rpu['foreman']['name'],
                    "id_sob" => $rpu['sob']['id_sob'],
                    "tgl_sob" => $rpu['sob']['created_at'],
                    "id_spb" => $rpu['spb']['id_spb'],
                    "tgl_spb" => $rpu['spb']['created_at'],
                    "pic_mcc" => $rpu['mcc']['name']
                ];
            }


            $spb['spb'][] = $push;
        }

        return $spb;
    }

    function create_spb($req, $flaging)
    {

        $id_spb = "SPB-" . TIME() . "-" . substr($req->idsob, 4);
        $spb = new Mpe_rpu_spb();
        $spb->no_rpu = trim($req->norpu);
        $spb->id_spb = trim($id_spb);
        $spb->flaging = trim($flaging);
        $spb->id_mccc_created_sob = trim($req->idmcc);
        $spb->status_id = trim(30);
        $spb->created_by = trim(Auth::user()->id);
        if ($spb->save()) {
            $this->insert_log(22, $req->norpu, '', '');
            $this->updatestatusrpu(30, $req->norpu, '', '', '');
            return true;
        } else {
            return false;
        }
    }
    // END PROSES IN WAREHOUSE

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
