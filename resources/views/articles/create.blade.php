<html>
<head>
    <title>Create article</title>
</head>
<body>
    <h1>
        Create a article
    </h1>

    <form method="post" action="{{ route("articles.store") }}">
        @csrf
        @method('post')
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
                <label>title</label>
                <input type="title" name="title" placeholder="title"/>

            </ul>
        </div>

        <div>
            <label>slug</label>
            <input type="text" name="slug" placeholder="slug"/>
        </div>

        <div>
            <label>excerpt</label>
            <input type="text" name="excerpt" placeholder="excerpt"/>
        </div>

        <div>
            <label>description</label>
            <input type="text" name="description" placeholder="description"/>
        </div>

        <div>
            <label>status</label>
            <input type="integer" name="status" placeholder="status"/>
        </div>

        <div>
            <input type="submit" value="save article"/>
        </div>

    </form>

</body>
</html>
