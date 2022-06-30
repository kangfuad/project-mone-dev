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

}
