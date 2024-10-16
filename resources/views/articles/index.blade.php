<html>
<head>
    <title>Article</title>

</head>
<body>
    <h1>
        Article
    </h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{ session ('success') }}
            </div>
        @endif
        <table border="1">
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>slug</th>
                <th>excerpt</th>
                <th>description</th>
                <th>status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{$article->article_id}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->slug}}</td>
                    <td>{{$article->excerpt}}</td>
                    <td>{{$article->description}}</td>
                    <td>{{$article->status}}</td>
                    <td>
                        <a href = ' {{ route('articles.edit', ['article' => $article]) }}'>Edit</a>
                    </td>
                    <td>
                        <form method="post" action="">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete">
                        </form>
                    </td>

                </tr>

            @endforeach
        </table>
    </div>
</body>
</html>
