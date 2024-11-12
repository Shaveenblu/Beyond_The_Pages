@extends('layouts.app')

@section('content')


    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card m-10 py-16">

        <h1 class="text-green-600 text-center text-xl">
            Create an article
        </h1>
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
                <label for="title" class="text-green-600 font-bold">Title</label>
                <br/>
                <input class="form-control border-1 focus:border-indigo-500 rounded-[10px] border-gray-300" type="text" name="title" placeholder="title"/>

            </ul>
        </div>

        <div class="m-5">
            <label class="form-label text-green-600 font-bold">Excerpt</label>
            <br/>
            <textarea name="excerpt" placeholder="excerpt" id="excerpt" class="border-0 focus:border-indigo-500 "></textarea>
        </div>

        <div class="m-5 ">
            <label class="form-label text-green-600 font-bold">Description</label>
            <br/>
            <textarea name="description" placeholder="description" id="description" class=" border-0 focus:border-indigo-500"></textarea>
        </div>


        <div class="m-5">
            <label class="text-green-600 font-bold">Tags</label>
            <br/>
            <select class="status form-multi-select w-full" name="status[]" multiple="required">
                @foreach($status as $tag)
                    <option value="{{ $tag->tag_id }}">{{ $tag->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="btn-custom m-5 ">
            <button type="submit" value="save article" class="btn btn-outline-success rounded-[10px] ">
                <i class="icon ion-md-save"></i>
                Create
            </button>
        </div>

    </form>
    </div>

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
