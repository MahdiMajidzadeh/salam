<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
