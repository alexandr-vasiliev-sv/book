<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AuthorRepository;
use App\Repositories\Criteria\Author\{
    GlobalSearch, SearchByAuthorName, SearchByTitle
};
use Illuminate\Http\Request;

class AuthorController extends BaseApiController
{
    /**
     * @var AuthorRepository
     */
    protected $authorController;

    /**
     * AuthorController constructor.
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorController = $authorRepository;
    }

    /**
     * @example
     *      /api/author/search?author=Doyle search by author
     *      /api/author/search?title=sherlock+holmes search by title (book)
     *      /api/author/search?q=sherlock+holmes search by books param (isbn, title, subtitle)
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $authors = $this->authorController;

        if ($request->has('title')) {
            $authors->pushCriteria(new SearchByTitle($request->get('title')));
        } elseif ($request->has('author')) {
            $authors->pushCriteria(new SearchByAuthorName($request->get('author')));
        } elseif ($request->has('q')) {
            $authors->pushCriteria(new GlobalSearch($request->get('q')));
        } else {
            $authors->with(['books']);
        }

        $authors = $authors->paginate();

        return $this->respondSuccess($authors);
    }
}