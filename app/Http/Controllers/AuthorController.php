<?php

namespace App\Http\Controllers;

use App\Entities\Author;
use App\Exceptions\EntityNotFound;
use App\Repositories\AuthorRepository;
use App\Repositories\Criteria\Author\AuthorWithBooksCount;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * AuthorController constructor.
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->authorRepository->paginate();

        return view('author.index', [
            'authors' => $authors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:authors',
        ]);

        $this->authorRepository->create($request->only('name'));

        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->getAuthor($id);
        $authorsBooks = $author->books()->paginate();

        return view('author.show', [
            'author' => $author,
            'authorsBooks' => $authorsBooks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = $this->getAuthor($id);

        return view('author.edit', [
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:authors,name,' . $id,
        ]);

        $this->authorRepository->update($request->only('name'), $id);

        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = $this->authorRepository->pushCriteria(new AuthorWithBooksCount)->find($id);

        if ($author !== null && $author->books_count === 0) { // todo It depends on the requirements
            $this->authorRepository->delete($id);
        }

        return redirect()->route('authors.index');
    }

    /**
     * @param $id
     * @return Author
     * @throws EntityNotFound
     */
    public function getAuthor($id)
    {
        if (($author = $this->authorRepository->find($id)) === null) {
            throw new EntityNotFound;
        }

        return $author;
    }
}
