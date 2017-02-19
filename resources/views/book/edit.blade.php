@extends('layouts.app')

@section('breadcrumbs')
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></li>
    <li class="active">Edit</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Update Book</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('book._form', [
                'model' => $book,
                'authors' => $authors,
            ])
        </div>
    </div>

@stop