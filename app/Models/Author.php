<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function Books()
    {
        $this->belongsToMany(Book::class);
    }
}
