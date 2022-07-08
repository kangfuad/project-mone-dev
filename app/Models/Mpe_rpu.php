<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return $this->hasManyThrough(
            Mpe_rpu_keluhan_listbarang::class,
            Mpe_rpu_keluhan::class,
            'no_rpu', // Foreign key on the environments table...
            'id_mpe_rpu_keluhan', // Foreign key on the deployments table...
            'no_rpu', // Local key on the projects table...
            'id' // Local key on the environments table...
        );

        // return $this->hasMany(Mpe_rpu_keluhan_listbarang::class, 'id', 'id_mpe_rpu_keluhan');
    }
}
