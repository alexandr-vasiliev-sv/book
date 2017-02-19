@extends('layouts.app')

@section('breadcrumbs')
    <li class="active">Books</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>
                Books
                <a href="{{ route('books.create') }}" class="btn btn-default pull-right">Create</a>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('book._booksTable', [
                'books' => $books
            ])
        </div>
    </div>
@stop