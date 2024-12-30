<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table        = 'roles';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
