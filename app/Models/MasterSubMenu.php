<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSubMenu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsTo(MasterRole::class, 'role_id', 'id_role');
    }
}
