@extends('layouts.app')

    @section('content')
    <div class="container  align-content-center" >
        @if(session()->has('success'))
            <div>
                {{ session ('success') }}
            </div>
        @endif

        <table border="1" class="table table-dark table0-striped">
            <tr>
                <th scope="col" class="text-green-600 text-xl">Title</th>
                <th scope="row" class="text-green-600 text-xl">Slug</th>
                <th scope="row" class="text-green-600 text-xl">Excerpt</th>
                <th scope="row" class="text-green-600 text-xl">Description</th>
                <th scope="row" class="text-green-600 text-xl">Status</th>
                <th scope="row" class="text-green-600 text-xl">Edit</th>
                <th scope="row" class="text-red-600 text-xl">Delete</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{$article->title}}</td>
                    <td>{{$article->slug}}</td>
                    <td>{{$article->excerpt}}</td>
                    <td>{{$article->description}}</td>
                    <td>{{$article->status}}</td>
                    <td>
                        <a href = ' {{ route('articles.edit', ['article' => $article]) }}'>Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('articles.destroy', ['article' => $article]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete"/>
                        </form>
                    </td>

                </tr>

            @endforeach
        </table>
    </div>

<script asset = "{{ asset('/bootstrap/js/bootstrap.js')}}"> </script>
@endsection
