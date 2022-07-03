<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpe_rpu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;
    public function foreman()
    {
        return $this->belongsTo(User::class, 'id_pic_foreman', 'id');
    }

    public function mcc()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function keluhan()
    {
        return $this->hasMany(Mpe_rpu_keluhan::class, 'no_rpu','no_rpu')->where('is_active','=', 1);
    }

}
