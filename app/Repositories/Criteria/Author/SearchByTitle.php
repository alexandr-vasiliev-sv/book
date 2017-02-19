<?php

namespace App\Repositories\Criteria\Author;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class SearchByTitle extends Criteria
{

    /**
     * @var string
     */
    private $title;

    /**
     * SearchByTitle constructor.
     * @param string $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->title) {
            $model = $model->whereHas('books', function ($query) {
                $query->where('title', 'like', "%{$this->title}%");
            })->with(['books' => function ($query) {
                $query->where('title', 'like', "%{$this->title}%");
            }]);
        }
        return $model;
    }
}