<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpe_rpu_sob extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id', 'kode_status');
    }

    public function mcc()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
