<?php

namespace App\Models;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'entity_id')->where('type_id', TypeEnum::BOOK);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
