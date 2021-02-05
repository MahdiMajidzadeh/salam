<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
