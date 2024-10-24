@extends('layouts.app')

@section('content')
<body>
<h1>
    Edit a article
</h1>
<div class="m-10">
<form method="post" action="{{route('articles.update', ['article' => $article])}}" >
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
        <label  class="form-label">title</label>
        <input type="title" name="title" placeholder="title" value="{{$article->title}}" class="form-control"/>
    </div>

    <div>
        <label class="form-label">excerpt</label>
        <textarea rows="5" cols="5" name="excerpt" placeholder="excerpt">{{ $article->excerpt }}</textarea>
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
</div>
<script asset = "{{ asset('/bootstrap/js/bootstrap.js')}}"> </script>
@endsection
