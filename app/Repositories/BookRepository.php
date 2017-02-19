<?php

namespace App\Repositories;

use App\Entities\Book;
use Bosnadev\Repositories\Eloquent\Repository;

class BookRepository extends Repository
{
    public function model()
    {
        return Book::class;
    }
}