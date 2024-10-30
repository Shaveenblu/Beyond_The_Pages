@extends('layouts.app')

@section('content')

    <h1 class="text-green-600 text-center text-xl">
        View articles
        <div class="m-4 col-m-5">
            <a href="{{ route('articles.create') }}" class="btn btn-outline-success">Create an Article</a>
        </div>
    </h1>

    <div class="container align-content-center">
        @if(session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        <table border="1" class="table table-dark table-striped">
            <tr>
                <th scope="col" class="text-green-600 text-xl">Title</th>
                <th scope="col" class="text-green-600 text-xl">Slug</th>
                <th scope="col" class="text-green-600 text-xl">Excerpt</th>
                <th scope="col" class="text-green-600 text-xl">Description</th>
                <th scope="col" class="text-green-600 text-xl">Status</th>
                <th scope="col" class="text-green-600 text-xl">Edit</th>
                <th scope="col" class="text-red-600 text-xl">Delete</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td class="text-sm">{{ $article->title }}</td>
                    <td class="text-sm">{{ $article->slug }}</td>
                    <td class="text-sm">{!! $article->excerpt !!}</td>
                    <td class="text-sm">{!! $article->description !!}</td>
                    <td class="text-sm">{{ $article->tag->name }}</td>
                    <td>
                        <a href="{{ route('articles.edit', ['article' => $article]) }}">Edit</a>
                    </td>
                    <td class="text-red-600">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $article->id }}">
                            Delete
                        </button>

                        <!-- Delete popup -->
                        <div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $article->id }}">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this article?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('articles.destroy', ['article' => $article]) }}" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Success message--}}
                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Article Deleted</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        The article has been successfully deleted.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </table>

    </div>

    <!-- Ensure Bootstrap and jQuery are included correctly -->


@endsection
