@extends('layouts.app')

@section('content')
<body class="grid-nav">
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
                {{-- Error display --}}
                    <li class="list-group-item d-flex align-items-center bg-danger text-white">
                        {{ $error }}
                    </li>
                @endforeach
            @endif
                 <br>
                <label for="title" class="text-green-600">Title</label>
                <br/>
                <input class="form-control border-0 focus:border-indigo-500" type="text" name="title" placeholder="title"/>

            </ul>
        </div>

        <div class="m-5">
            <label class="form-label text-green-600">Excerpt</label>
            <br/>
            <textarea name="excerpt" placeholder="excerpt" rows="2" cols="100" id="excerpt" class="border-0 focus:border-indigo-500"></textarea>
        </div>

        <div class="m-5 ">
            <label class="form-label text-green-600">Description</label>
            <br/>
            <textarea name="description" placeholder="description" rows="20" cols="100" id="description" class=" border-0 focus:border-indigo-500"></textarea>
        </div>


        <div class="m-5">
            <label class="text-green-600">Category</label>
            <br/>
            <select class="status form-multi-select" name="status[]" multiple="multiple">
                @foreach($status as $tag)
                    <option value="{{ $tag->tag_id }}">{{ $tag->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="btn-custom m-5 ">
            <button type="submit" value="save article" class="btn btn-outline-success">Submit</button>
        </div>

    </form>

    <script>
        // code for WYSWYG editor description
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        // code for WYSWYG editor excerpt
        ClassicEditor
            .create(document.querySelector('#excerpt'))
            .catch(error => {
                console.error(error);
            });
        // JS snippet for select2
        $(document).ready(function() {
            $('.status').select2();
        });
    </script>

    <script asset = "{{ asset('/bootstrap/js/bootstrap.js')}}"> </script>
@endsection
