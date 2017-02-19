<?php

namespace App\Repositories\Criteria\Author;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class AuthorWithBooksCount extends Criteria
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->withCount('books');

        return $model;
    }
}