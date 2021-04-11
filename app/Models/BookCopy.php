<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function salon()
    {
        return $this->belongsTo(TahdigSalon::class, 'salon_id');
    }
}
