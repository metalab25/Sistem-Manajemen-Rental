<?php

namespace App\Models;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table        = 'customers';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
