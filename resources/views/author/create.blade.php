@extends('layouts.app')

@section('breadcrumbs')
    <li><a href="{{ route('authors.index') }}">Authors</a></li>
    <li class="active">Create</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>
                Create Author
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('author._form', [
                'model' => new \App\Entities\Author(),
            ])
        </div>
    </div>

@stop