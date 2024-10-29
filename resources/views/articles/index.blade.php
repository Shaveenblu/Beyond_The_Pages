@extends('layouts.app')

    @section('content')
        <h1 class="text-green-600 text-center text-xl">
            View articles
            <div class="m-4 col-m-5">
                <a href="{{ route('articles.create') }}" class="btn btn-outline-success">Create an Article</a>
            </div>
        </h1>

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
                    <td class="text-sm">{{ $article->title }}</td>
                    <td class="text-sm">{{ $article->slug }}</td>
                    <td class="text-sm">{{ $article->excerpt }}</td>
                    <td class="text-sm">{{ $article->description }}</td>
                    <td class="text-sm">{{ $article->tag->name }}</td>
                    <td>
                        <a href = ' {{ route('articles.edit', ['article' => $article]) }}'>Edit</a>
                    </td>

                    <td class=" text-red-600">
                        <form method="post" action="{{ route('articles.destroy', ['article' => $article]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" value="Delete" data-toggle="" data-target="">Delete</button>

                            <!-- Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </td>

                </tr>

            @endforeach
        </table>
    </div>
<script>

</script>
<script asset = "{{ asset('/bootstrap/js/bootstrap.js')}}"> </script>
@endsection
