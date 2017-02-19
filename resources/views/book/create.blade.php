@extends('layouts.app')

@section('breadcrumbs')
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li class="active">Create</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Create Book</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('book._form', [
                'model' => new \App\Entities\Book(),
                'authors' => $authors,
            ])
        </div>
    </div>

@stop