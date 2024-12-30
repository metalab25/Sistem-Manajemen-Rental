<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    protected $table        = 'kas_masuks';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'input_by');
    }
}
