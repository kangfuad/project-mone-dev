<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpe_log extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id', 'kode_status');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function role()
    {
        return $this->belongsTo(MasterRole::class, 'role_id', 'id_role');
    }

}
