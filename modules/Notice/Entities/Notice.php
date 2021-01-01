<?php

namespace Modules\Notice\Entities;

use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
