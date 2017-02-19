<?php

namespace App\Repositories\Criteria\Author;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class SearchByAuthorName extends Criteria
{

    /**
     * @var string
     */
    private $authorName;

    /**
     * SearchByTitle constructor.
     * @param string $authorName
     */
    public function __construct($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->authorName) {
            $model = $model->with(['books'])->where('name', 'like', "%{$this->authorName}%");
        }
        return $model;
    }
}