<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpe_rpu_keluhan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;
    public function barang()
    {
        return $this->belongsTo(Mpe_rpu_keluhan_listbarang::class, 'id', 'id_mpe_rpu_keluhan');
    }
}
