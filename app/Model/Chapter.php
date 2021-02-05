<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
