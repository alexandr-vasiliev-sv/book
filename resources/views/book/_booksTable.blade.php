<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Title</th>
        <th>ISBN</th>
        <th>Sub title</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->sub_title }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $books->render() }}