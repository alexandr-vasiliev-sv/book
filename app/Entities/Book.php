<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'isbn', 'title', 'sub_title',
    ];

    protected $visible = [
        'isbn', 'title', 'sub_title',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

}
