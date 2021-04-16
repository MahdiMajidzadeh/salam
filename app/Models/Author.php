<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    public function Books()
    {
        $this->belongsToMany(Book::class);
    }
}
