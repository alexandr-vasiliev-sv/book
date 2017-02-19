<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $visible = [
        'name', 'books'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
