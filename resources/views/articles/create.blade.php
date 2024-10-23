<html>
<head>
    <title>Create article</title>
</head>
<body>
    <h1>
        Create an article
    </h1>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('articles.store') }}">
        @csrf
        @method('post')
        <div>
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
{{--                     Error display--}}
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            @endif
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="title"/>

            </ul>
        </div>

        <div class="form-group">
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

        <div class="btn-custom">
            <input type="submit" value="save article"/>
        </div>

    </form>

</body>
</html>
