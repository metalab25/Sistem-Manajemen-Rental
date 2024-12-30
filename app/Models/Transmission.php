<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    protected $table        = 'transmissions';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
}
