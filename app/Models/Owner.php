<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table        = 'owners';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
}
