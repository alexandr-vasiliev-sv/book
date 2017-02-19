@extends('layouts.app')

@section('breadcrumbs')
    <li><a href="{{ route('authors.index') }}">Authors</a></li>
    <li class="active">{{ $author->name }}</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>
                {{ $author->name }}
                <small><a href="{{ route('authors.edit', $author->id) }}">Edit</a></small>
                <button form="deleteAuthor" class="btn btn-danger pull-right" type="submit">
                    Delete
                </button>
                <form id="deleteAuthor" action="{{ route('authors.destroy', $author->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>{{ $authorsBooks->total() . ' ' . str_plural('work', $authorsBooks->total()) }}</h3>
            @include('book._booksTable', [
                 'books' => $authorsBooks,
            ])
        </div>
    </div>

@stop