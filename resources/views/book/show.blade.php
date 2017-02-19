@extends('layouts.app')

@section('breadcrumbs')
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li class="active">{{ $book->title }}</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>
                {{ $book->title }}
                <small><a href="{{ route('books.edit', $book->id) }}">Edit</a></small>
                <button form="deleteBook" class="btn btn-danger pull-right" type="submit">
                    Delete
                </button>
                <form id="deleteBook" action="{{ route('books.destroy', $book->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <td><b>Sub title</b></td>
                    <td>{{ $book->sub_title }}</td>
                </tr>
                <tr>
                    <td><b>ISBN</b></td>
                    <td>{{ $book->isbn }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>{{ str_plural('Author', $booksAuthors->total()) }}</h1>
            @include('author._authorsTable', [
                'authors' => $booksAuthors,
            ])
        </div>
    </div>

@stop