@extends('layouts.app')

@section('content')
<body>
    <h1 class="text-green-600 text-center text-xl">
        Create an article
    </h1>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('articles.store') }} ">
        @csrf
        @method('post')
        <div class="m-5">
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
{{--                     Error display--}}
                    <li class="bg-red-600">
                        {{ $error }}
                    </li>
                @endforeach
            @endif
                 <br>
                <label for="title">Title</label>
                <br/>
                <input type="text" name="title" placeholder="title"/>

            </ul>
        </div>

{{--        <div class="form-group">--}}
{{--            <label>slug</label>--}}
{{--            <input type="text" name="slug" placeholder="slug"/>--}}
{{--        </div>--}}

        <div class="m-5">
            <label class="form-label">Excerpt</label>
            <br/>
            <textarea name="excerpt" placeholder="excerpt" class="" rows="2" cols="100"></textarea>
        </div>

        <div class="m-5">
            <label class="form-label">Description</label>
            <br/>
            <textarea name="description" placeholder="description" rows="20" cols="100"></textarea>
        </div>

        <div class="m-5">
            <label>Status</label>
            <br/>
            <input type="integer" name="status" placeholder="status"/>
        </div>

        <div class="btn-custom m-5">
            <button type="submit" value="save article" class="btn btn-dark">Submit</button>
        </div>

    </form>

    <script asset = "{{ asset('/bootstrap/js/bootstrap.js')}}"> </script>
@endsection
