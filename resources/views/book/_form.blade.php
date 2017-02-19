<?php
/** $model App\Entities\Book */
/** $authors App\Entities\Authors */
$isNew = !$model->exists;
?>
<form class="form-horizontal" method="POST"
      action="{{ ($isNew) ? route('books.store') : route('books.update', $model->id) }}">

    @if (!$isNew)
        {{ method_field('put') }}
    @endif

    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('isbn') ? ' has-error' : '' }}">
        <label for="isbn" class="col-sm-2 control-label">ISBN</label>
        <div class="col-sm-10">
            <input type="text" name="isbn" class="form-control" id="isbn" placeholder="isbn"
                   value="{{ old('isbn') ?? $model->isbn }}">

            @if ($errors->has('isbn'))
                <span class="help-block">
                    <strong>{{ $errors->first('isbn') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="title"
                   value="{{ old('title') ?? $model->title }}">

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('sub_title') ? ' has-error' : '' }}">
        <label for="sub_title" class="col-sm-2 control-label">Sub Title</label>
        <div class="col-sm-10">
            <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="sub title"
                   value="{{ old('sub_title') ?? $model->sub_title }}">

            @if ($errors->has('sub_title'))
                <span class="help-block">
                    <strong>{{ $errors->first('sub_title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('authors') ? ' has-error' : '' }}">
        <label for="authors" class="col-sm-2 control-label">Authors</label>
        <div class="col-sm-10">
            <?php
                $bookAuthor = ($isNew) ? [] : $model->authors->pluck('id')->toArray();

                $authorsIds = array_merge($bookAuthor, old('authors', []));
            ?>
            <select name="authors[]" id="authors" class="form-control" multiple>

                @foreach($authors as $author)
                    <option value="{{ $author->id }}"
                            {{ array_search($author->id, $authorsIds) !== false ? 'selected' : ''  }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('authors'))
                <span class="help-block">
                    <strong>{{ $errors->first('authors') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">{{ $isNew ? 'Create' : 'Update' }}</button>
        </div>
    </div>

</form>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#authors').select2({
            placeholder: 'Select an option'
        });
    </script>
@endpush