<?php

namespace App\Models;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table        = 'companies';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
