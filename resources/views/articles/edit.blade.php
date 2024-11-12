@extends('layouts.app')

@section('content')


    <h1 class="text-green-600 text-center text-xl">
        Edit an Article
    </h1>

    <div class="card m-10">
        <div class="card-body">
        <h4 class="">
            <a href="{{ route('articles.index') }}" class="mr-5"><i class="icon ion-md-arrow-back"></i> Go back</a>

        </h4>
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
                <label class="form-label text-green-600 font-bold">Title</label>
                <br/>
                <input  class="border-1 focus:border-indigo-500 rounded-[10px] w-full border-gray-300" type="text" name="title" placeholder="Title" value="{{ $article->title }}" class="form-control"/>
            </div>

            <div class="m-5">
                <label class="form-label text-green-600 font-bold">Excerpt</label>
                <br/>
                <textarea class="border-0 focus:border-indigo-500" rows="5" cols="100" name="excerpt" placeholder="Excerpt" id="excerpt">{{ $article->excerpt }}</textarea>
            </div>

            <div class="m-5 ">
                <label class="text-green-600 font-bold">Description</label>
                <br/>
                <textarea name="description" id="description" placeholder="Description" rows="20" cols="100" class="border-0 focus:border-indigo-500">{{ $article->description }}</textarea>
            </div>

            <div class="m-5 ">
                <label class="text-green-600 font-bold">Tags</label>
                <br/>
                <select class="status form-multi-select w-full" name="status[]" multiple="multiple" >
                    @foreach($article->tags as $tag)
                        <option value="{{ $tag->tag_id }}" selected>{{ $tag->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="m-5 text-green-600">
                <button type="submit" value="Update" class="btn btn-outline-success rounded-[10px]">
                    <i class="icon ion-md-save"></i>
                    UPDATE
                </button>
            </div>

        </form>

    </div>
        </div>
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
