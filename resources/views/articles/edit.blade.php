@extends('layouts.app')

@section('content')

    <body>
    <h1 class="text-green-600 text-center text-xl">
        Edit an Article
    </h1>
    <div class="m-10">
        <form method="post" action="{{ route('articles.update', ['article' => $article]) }}">
            @csrf
            @method('put')
            <div class="m-5">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="m-5">
                <label class="form-label text-green-600">Title</label>
                <br/>
                <input  class="border-0 focus:border-indigo-500" type="text" name="title" placeholder="Title" value="{{ $article->title }}" class="form-control"/>
            </div>

            <div class="m-5">
                <label class="form-label text-green-600">Excerpt</label>
                <br/>
                <textarea class="border-0 focus:border-indigo-500" rows="5" cols="100" name="excerpt" placeholder="Excerpt" id="excerpt">{{ $article->excerpt }}</textarea>
            </div>

            <div class="m-5 ">
                <label class="text-green-600">Description</label>
                <br/>
                <textarea name="description" id="description" placeholder="Description" rows="20" cols="100" class="border-0 focus:border-indigo-500">{{ $article->description }}</textarea>
            </div>

            <div class="m-5 ">
                <label class="text-green-600">Tags</label>
                <br/>
                <select class="status form-multi-select" name="status[]" multiple="multiple">
                    @foreach($status as $tag)
                        <option value="{{ $tag->tag_id }}">{{ $tag->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="m-5 text-green-600">
                <button type="submit" value="Update" class="btn btn-outline-success">UPDATE</button>
            </div>


        </form>

    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#excerpt'))
            .catch(error => {
                console.error(error);
            });
        $(document).ready(function() {
            $('.status').select2();
        });
    </script>

    <script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
@endsection
