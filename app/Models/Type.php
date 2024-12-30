<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table        = 'types';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
}
