<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
        <tr>
            <td>
                <a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $authors->render() }}