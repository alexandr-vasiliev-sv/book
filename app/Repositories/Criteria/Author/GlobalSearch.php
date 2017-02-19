<?php

namespace App\Repositories\Criteria\Author;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class GlobalSearch extends Criteria
{

    /**
     * @var string
     */
    private $searchString;

    /**
     * SearchByTitle constructor.
     * @param string $searchString
     */
    public function __construct($searchString)
    {
        if ($searchString) {
            $this->searchString = '%' . $searchString . '%';
        }
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->searchString) {
            $model = $model->orWhereHas('books', function ($query) {
                    $this->searchForRelation($query);
                })->with(['books' => function ($query) {
                    $this->searchForRelation($query);
                }]);
        }
        return $model;
    }

    private function searchForRelation($query)
    {
        return $query->where('isbn', 'like', $this->searchString)
            ->orWhere('title', 'like', $this->searchString)
            ->orWhere('sub_title', 'like', $this->searchString);
    }
}