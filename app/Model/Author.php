<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function Books()
    {
        $this->belongsToMany(Book::class);
    }
}
