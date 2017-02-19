<?php

namespace App\Repositories;

use App\Entities\Author;
use Bosnadev\Repositories\Eloquent\Repository;

class AuthorRepository extends Repository
{
    public function model()
    {
        return Author::class;
    }
}