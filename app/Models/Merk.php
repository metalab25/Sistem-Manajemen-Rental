<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table        = 'merks';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'merk_id');
    }
}
