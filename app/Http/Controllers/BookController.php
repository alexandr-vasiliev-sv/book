<?php

namespace App\Http\Controllers;

use App\Entities\Book;
use App\Exceptions\EntityNotFound;
use App\Repositories\ {
    AuthorRepository, BookRepository
};
use Illuminate\Http\Request;
use DB;

class BookController extends Controller
{
    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * BookController constructor.
     * @param BookRepository $bookRepository
     * @param AuthorRepository $authorRepository
     */
    public function __construct(BookRepository $bookRepository, AuthorRepository $authorRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookRepository->paginate();

        return view('book.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->authorRepository->all(['id', 'name']);

        return view('book.create', [
            'authors' => $authors,
        ]);
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
            'title' => 'required|unique:books',
            'sub_title' => 'required|unique:books',
            'isbn' => 'required|unique:books',
            'authors' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {
            $book = $this->bookRepository->create($request->only(['isbn', 'title', 'sub_title']));
            $book->authors()->sync($request->get('authors'));
        });


        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->getBook($id);
        $booksAuthors = $book->authors()->paginate();

        return view('book.show', [
            'book' => $book,
            'booksAuthors' => $booksAuthors,
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
        $book = $this->getBook($id);
        $book->load('authors');
        $authors = $this->authorRepository->all(['id', 'name']);

        return view('book.edit', [
            'book' => $book,
            'authors' => $authors,
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
            'title' => 'required|unique:books,title,' . $id,
            'sub_title' => 'required|unique:books,sub_title,' . $id,
            'isbn' => 'required|unique:books,isbn,' . $id,
        ]);

        $this->bookRepository->update($request->only(['isbn', 'title', 'sub_title']), $id);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bookRepository->delete($id);

        return redirect()->route('books.index');
    }

    /**
     * @param $id
     * @return Book
     * @throws EntityNotFound
     */
    protected function getBook($id)
    {
        if (($book = $this->bookRepository->find($id)) === null) {
            throw new EntityNotFound();
        }
        return $book;
    }
}
