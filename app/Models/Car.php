<?php

namespace App\Models;

use App\Models\Fuel;
use App\Models\Merk;
use App\Models\Rental;
use App\Models\Passenger;
use App\Models\Transmission;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table        = 'cars';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
