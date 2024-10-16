<html>
<head>
    <title>Create article</title>
</head>
<body>
<h1>
    Edit a article
</h1>

<form method="post" action="{{route('articles.update', ['articles' => $article])}}">
    @csrf
    @method('put')
    <div>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    {{--                     Error display--}}
                    <li>
                        {{ $error  }}
                    </li>

                @endforeach
                @endif


            </ul>
    </div>

    <div>
        <label>title</label>
        <input type="title" name="title" placeholder="title" value="{{$article->title}}"/>
    </div>

    <div>
        <label>slug</label>
        <input type="text" name="slug" placeholder="slug" value="{{$article->slug}}"/>
    </div>

    <div>
        <label>excerpt</label>
        <input type="text" name="excerpt" placeholder="excerpt" value="{{ $article->excerpt }}"/>
    </div>

    <div>
        <label>description</label>
        <input type="text" name="description" placeholder="description" value="{{ $article->description }}"/>
    </div>

    <div>
        <label>status</label>
        <input type="integer" name="status" placeholder="status" value="{{ $article->status }}"/>
    </div>

    <div>
        <input type="submit" value="Update"/>
    </div>

</form>

</body>
</html>
