@extends('layouts.app')

@section('breadcrumbs')
    <li><a href="{{ route('authors.index') }}">Authors</a></li>
    <li><a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a></li>
    <li class="active">Edit</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>
                Update Author
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('author._form', [
                'model' => $author,
            ])
        </div>
    </div>

@stop