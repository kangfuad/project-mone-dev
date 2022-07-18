<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;


class Mpe_rpu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;
    public function foreman()
    {
        return $this->belongsTo(User::class, 'id_pic_foreman', 'id');
    }

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id', 'kode_status');
    }

    public function mcc()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function keluhan()
    {
        return $this->hasMany(Mpe_rpu_keluhan::class, 'no_rpu', 'no_rpu')->where('is_active', '=', 1);
    }

    public function listing()
    {
        return $this->hasMany(Mpe_rpu_keluhan_listbarang::class, 'no_rpu', 'no_rpu')->where('is_active', '=', 1);
    }

    public function sob()
    {
        return $this->belongsTo(Mpe_rpu_sob::class, 'no_rpu', 'no_rpu')->where(['is_active' => 1, 'id_pic_wharehouse' => Auth::user()->id]);
    }

    public function spb()
    {
        return $this->belongsTo(Mpe_rpu_spb::class, 'no_rpu', 'no_rpu')->where(['is_active' => 1, 'created_by' => Auth::user()->id]);
    }
}
