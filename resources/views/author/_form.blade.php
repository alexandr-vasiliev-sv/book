<?php
    /** $model App\Entities\Author */
    $isNew = !$model->exists;
?>
<form class="form-horizontal" method="POST"
      action="{{ ($isNew) ? route('authors.store') : route('authors.update', $model->id) }}">

    @if (!$isNew)
        {{ method_field('put') }}
    @endif

    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" placeholder="name"
                   value="{{ old('name') ?? $model->name }}">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
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