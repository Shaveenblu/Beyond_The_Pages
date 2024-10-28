@extends('layouts.app')

@section('content')
<body>
<h1 class="text-green-600 text-center text-xl">
    Edit a article
</h1>
<div class="m-10">
<form method="post" action="{{route('articles.update', ['article' => $article])}}" >
    @csrf
    @method('put')
    <div class="m-5">
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

    <div class="m-5">
        <label  class="form-label ">Title</label>
        <br/>
        <input type="text" name="title" placeholder="title" value="{{$article->title}}" class="form-control"/>
    </div>

    <div class="m-5">
        <label class="form-label">Excerpt</label>
        <br/>
        <textarea rows="5" cols="100" name="excerpt" placeholder="excerpt">{{ $article->excerpt }}</textarea>
    </div>

    <div class="m-5">
        <label>Description</label>
        <br/>
        <textarea name="description" placeholder="description" rows="20" cols="100">{{ $article->description }}</textarea>
    </div>

    <div class="m-5">
        <label>Status</label>
        <br/>
        <input type="integer" name="status" placeholder="status" value="{{ $article->status }}"/>
    </div>

    <div class="m-5">
        <button type="submit" value="Update" class="btn btn-outline-success">UPDATE</button>
    </div>

</form>
</div>
<script asset = "{{ asset('/bootstrap/js/bootstrap.js')}}"> </script>
@endsection
