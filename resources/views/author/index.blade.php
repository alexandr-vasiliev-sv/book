@extends('layouts.app')

@section('breadcrumbs')
    <li class="active">Authors</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>
                Authors
                <a href="{{ route('authors.create') }}" class="btn btn-default pull-right">Create</a>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('author._authorsTable', [
                'authors' => $authors,
            ])
        </div>
    </div>
@stop